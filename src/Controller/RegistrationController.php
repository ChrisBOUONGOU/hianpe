<?php
namespace App\Controller;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
final class RegistrationController extends AbstractController {
    #[Route('/inscription',name:'app_register',methods:['GET','POST'])]
    public function register(Request $request,UserPasswordHasherInterface $hasher,EntityManagerInterface $em):Response {
        if($this->getUser()) return $this->redirectToRoute('account');
        $error=null;
        if($request->isMethod('POST')){
            $email=mb_strtolower(trim((string)$request->request->get('email')));
            $password=(string)$request->request->get('password');
            $confirmation=(string)$request->request->get('password_confirmation');
            if(!$this->isCsrfTokenValid('register',(string)$request->request->get('_token'))) $error='La session du formulaire a expiré. Réessaie.';
            elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)) $error='Entre une adresse courriel valide.';
            elseif(strlen($password)<12) $error='Le mot de passe doit contenir au moins 12 caractères.';
            elseif($password!==$confirmation) $error='Les deux mots de passe ne correspondent pas.';
            elseif($em->getRepository(User::class)->findOneBy(['email'=>$email])) $error='Un compte existe déjà avec cette adresse courriel.';
            else {
                $user=(new User())->setEmail($email);
                $user->setPassword($hasher->hashPassword($user,$password));
                $em->persist($user);$em->flush();
                $this->addFlash('success','Ton compte Hianpe a été créé. Tu peux maintenant te connecter.');
                return $this->redirectToRoute('app_login');
            }
        }
        return $this->render('security/register.html.twig',['error_message'=>$error]);
    }
}
