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

class ForgetPasswordController extends AbstractController
{

    /**
     * @Route("/forgetpassword", name="forget_password")
     */
    public function forgottenPassword(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        \Swift_Mailer $mailer
    ): Response
    {

        if ($request->isMethod('POST')) {

            $email = $request->request->get('email');

            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneByEmail($email);
            /* @var $user User */

            if ($user === null) {
                $this->addFlash('danger', 'Utilisateur inconnu, merci de vérifier l\'email');
                // return $this->redirectToRoute('home');
            } else {

                $token = $user->getToken();

                try{
                    $entityManager->flush();
                } catch (\Exception $e) {
                    $this->addFlash('warning', $e->getMessage());
                    return $this->redirectToRoute('home');
                }
    
                $url = $this->generateUrl('reset_password', array('token' => $token, 'mail' => $email), UrlGeneratorInterface::ABSOLUTE_URL);
    
                $message = (new \Swift_Message('Forgot Password'))
                    ->setFrom('g.ponty@dev-web.io')
                    ->setTo($user->getEmail())
                    ->setBody(
                        'Bonjour voici le lien pour remettre a zero votre mot de passe : <a href="' . $url . '">Remettre a zero son mot de passe</a>',
                        'text/html'
                    );
    
                $mailer->send($message);
    
                $this->addFlash('notice', 'Mail envoyé');
            }


            //return $this->redirectToRoute('home');
        }

        return $this->render('security/index.html.twig');
    }
}
