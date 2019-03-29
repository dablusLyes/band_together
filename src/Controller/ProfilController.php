<?php

namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil/{id}", name="profil", methods={"GET","POST"})
     */
    public function index( User $user, Request $request)
    {
        return $this->render('profil/index.html.twig', [
            'user' => $user
        ]);
    }
}