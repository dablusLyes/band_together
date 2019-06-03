<?php

namespace App\Controller;



use App\Form\ProfileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profile", methods={"GET","POST"})
     */
    public function index( Request $request )
    {
        $user = $this->getUser();
        if(!$user) {
            throw $this->createNotFoundException('The user does not exist');
        }

        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        return $this->render('profil/index.html.twig', [
            'user' => $user,
            'profileForm' => $form->createView()
        ]);
    }
}
