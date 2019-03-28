<?php

namespace App\Controller;

use App\Form\ProfilType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserFrontController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function index(Request $request)
    {


        $user = $this->getUser();
        //dd($user);
        if(!$user) {
            throw $this->createNotFoundException('The user does not exist');
        }

        $form = $this->createForm(ProfilType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );
            return $this->redirectToRoute('profil');
        }
        return $this->render('profil/index.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
