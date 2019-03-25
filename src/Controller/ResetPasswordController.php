<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordController extends AbstractController
{
    /**
     * @Route("/resetpassword/{token}{mail}", name="reset_password")
     */

     public function resetPassword(Request $request, UserPasswordEncoderInterface $passwordEncoder, $token, $mail)
     {

       $entityManager = $this->getDoctrine()->getManager();

       $user = $entityManager->getRepository(User::class)->findOneByEmail($mail);
       /* @var $user User */

       if ($user === null) {
           $this->addFlash('danger', 'Token Inconnu');
           return $this->redirectToRoute('home');
       }


         if ($request->isMethod('POST')) {

             $user->setToken($user->generateToken());
             $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
             $entityManager->flush();

             $this->addFlash('notice', 'Mot de passe mis à jour');

             return $this->redirectToRoute('home');
         }

          return $this->render('security/reset.html.twig', ['token' => $token]);


     }
}
