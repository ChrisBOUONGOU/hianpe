<?php
namespace App\Controller;
use App\Repository\SubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
#[IsGranted('ROLE_USER')]
final class AccountController extends AbstractController {
    #[Route('/compte',name:'account',methods:['GET'])]
    public function index(SubscriptionRepository $subscriptions):Response {
        return $this->render('account/index.html.twig',['subscriptions'=>$subscriptions->findForUser($this->getUser())]);
    }
}
