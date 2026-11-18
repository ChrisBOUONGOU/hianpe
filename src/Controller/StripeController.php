<?php
namespace App\Controller;
use App\Entity\Subscription;
use App\Entity\User;
use App\Repository\SubscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Exception\SignatureVerificationException;
use Stripe\StripeClient;
use Stripe\Webhook;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use UnexpectedValueException;
final class StripeController extends AbstractController {
    public function __construct(
        #[Autowire('%env(STRIPE_SECRET_KEY)%')] private readonly string $secretKey,
        #[Autowire('%env(STRIPE_WEBHOOK_SECRET)%')] private readonly string $webhookSecret,
        #[Autowire('%env(STRIPE_PRICE_STAGEFLOW)%')] private readonly string $stageflowPrice,
        #[Autowire('%env(STRIPE_PRICE_AFRIHOSPITAL)%')] private readonly string $afrihospitalPrice,
        #[Autowire('%env(STRIPE_PRICE_STOCKFLOW)%')] private readonly string $stockflowPrice
    ) {}
    #[Route('/abonnements/checkout/{product}',name:'stripe_checkout',methods:['POST'])]
    #[IsGranted('ROLE_USER')]
    public function checkout(string $product,Request $request,SubscriptionRepository $subscriptions):Response {
        $product=strtolower($product);
        if(!$this->isCsrfTokenValid('checkout_'.$product,(string)$request->request->get('_token'))) throw $this->createAccessDeniedException('Jeton de sécurité invalide.');
        $priceId=$this->priceFor($product);
        if(!$priceId || !$this->secretKey){$this->addFlash('error','Le paiement n’est pas encore configuré.');return $this->redirectToRoute('account');}
        $user=$this->getUser();
        if(!$user instanceof User) throw $this->createAccessDeniedException();
        if($subscriptions->findActiveForProduct($user,$product)){$this->addFlash('info','Tu as déjà un abonnement en cours pour ce logiciel.');return $this->redirectToRoute('account');}
        try {
            $session=(new StripeClient($this->secretKey))->checkout->sessions->create([
                'mode'=>'subscription',
                'customer_email'=>$user->getEmail(),
                'client_reference_id'=>(string)$user->getId(),
                'line_items'=>[['price'=>$priceId,'quantity'=>1]],
                'payment_method_collection'=>'always',
                'subscription_data'=>['trial_period_days'=>7,'metadata'=>['user_id'=>(string)$user->getId(),'product_key'=>$product]],
                'metadata'=>['user_id'=>(string)$user->getId(),'product_key'=>$product],
                'success_url'=>$this->generateUrl('stripe_success',[],0).'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url'=>$this->generateUrl('account',[],0),
                'allow_promotion_codes'=>true
            ]);
            return $this->redirect($session->url,Response::HTTP_SEE_OTHER);
        } catch (\Throwable $e) {
            $this->addFlash('error','Impossible de démarrer le paiement. Vérifie la configuration Stripe et réessaie.');
            return $this->redirectToRoute('account');
        }
    }
    #[Route('/abonnements/succes',name:'stripe_success',methods:['GET'])]
    #[IsGranted('ROLE_USER')]
    public function success():Response {
        $this->addFlash('success','Merci ! Stripe confirme ton inscription. Ton abonnement apparaîtra ici après réception de la confirmation.');
        return $this->redirectToRoute('account');
    }
    #[Route('/abonnements/portail',name:'stripe_portal',methods:['POST'])]
    #[IsGranted('ROLE_USER')]
    public function portal(Request $request,SubscriptionRepository $subscriptions):Response {
        if(!$this->isCsrfTokenValid('stripe_portal',(string)$request->request->get('_token'))) throw $this->createAccessDeniedException('Jeton de sécurité invalide.');
        $user=$this->getUser();
        if(!$user instanceof User) throw $this->createAccessDeniedException();
        $items=$subscriptions->findForUser($user);
        $customerId=$items[0]->getStripeCustomerId() ?? null;
        if(!$customerId){$this->addFlash('info','Aucun client Stripe n’est encore associé à ton compte.');return $this->redirectToRoute('account');}
        try {
            $portal=(new StripeClient($this->secretKey))->billingPortal->sessions->create(['customer'=>$customerId,'return_url'=>$this->generateUrl('account',[],0)]);
            return $this->redirect($portal->url,Response::HTTP_SEE_OTHER);
        } catch (\Throwable $e) {
            $this->addFlash('error','Impossible d’ouvrir le portail de facturation.');return $this->redirectToRoute('account');
        }
    }
    #[Route('/stripe/webhook',name:'stripe_webhook',methods:['POST'])]
    public function webhook(Request $request,EntityManagerInterface $em,SubscriptionRepository $subscriptions):Response {
        try {
            $event=Webhook::constructEvent($request->getContent(),(string)$request->headers->get('stripe-signature'),$this->webhookSecret);
        } catch (UnexpectedValueException|SignatureVerificationException $e) {
            return new Response('Invalid webhook signature',Response::HTTP_BAD_REQUEST);
        }
        $object=$event->data->object;
        if(in_array($event->type,['customer.subscription.created','customer.subscription.updated','customer.subscription.deleted'],true)) {
            $this->syncSubscription($object,$em,$subscriptions);
        } elseif($event->type==='checkout.session.completed' && !empty($object->subscription)) {
            try {
                $sub=(new StripeClient($this->secretKey))->subscriptions->retrieve((string)$object->subscription,[]);
                $this->syncSubscription($sub,$em,$subscriptions);
            } catch (\Throwable $e) { return new Response('Subscription retrieval failed',Response::HTTP_INTERNAL_SERVER_ERROR); }
        }
        return new Response('ok',Response::HTTP_OK);
    }
    private function syncSubscription(object $stripeSub,EntityManagerInterface $em,SubscriptionRepository $repository):void {
        $metadata=$stripeSub->metadata ?? null;
        $userId=isset($metadata->user_id)?(int)$metadata->user_id:0;
        $key=isset($metadata->product_key)?(string)$metadata->product_key:'';
        if($userId<1 || !in_array($key,['stageflow','afrihospital','stockflow'],true)) return;
        $user=$em->getRepository(User::class)->find($userId);
        if(!$user instanceof User) return;
        $stripeId=(string)$stripeSub->id;
        $sub=$repository->findByStripeId($stripeId);
        if(!$sub) $sub=(new Subscription())->setUser($user)->setProductKey($key)->setStripeSubscriptionId($stripeId);
        $customer=$stripeSub->customer ?? '';
        if(is_object($customer) && isset($customer->id)) $customer=$customer->id;
        $sub->setStripeCustomerId((string)$customer);
        $sub->setStatus((string)($stripeSub->status ?? 'unknown'));
        $sub->setCancelAtPeriodEnd((bool)($stripeSub->cancel_at_period_end ?? false));
        $trialEnd=$stripeSub->trial_end ?? null;
        $periodEnd=$stripeSub->current_period_end ?? null;
        $sub->setTrialEndsAt($trialEnd?(new \DateTimeImmutable())->setTimestamp((int)$trialEnd):null);
        $sub->setCurrentPeriodEndsAt($periodEnd?(new \DateTimeImmutable())->setTimestamp((int)$periodEnd):null);
        $em->persist($sub);$em->flush();
    }
    private function priceFor(string $key):?string {
        return match($key){'stageflow'=>$this->stageflowPrice,'afrihospital'=>$this->afrihospitalPrice,'stockflow'=>$this->stockflowPrice,default=>null};
    }
}
