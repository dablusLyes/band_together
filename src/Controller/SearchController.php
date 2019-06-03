<?php

namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    /**
     * @Route("/recherche", name="search", methods={"GET","POST"})
     */
    public function index(  )
    {
        $user = $this->getUser();
        if(!$user) {
            throw $this->createNotFoundException('The user does not exist');
        }

        return $this->render('search/index.html.twig', [
            'user' => $user,
        ]);
    }
}