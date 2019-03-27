<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GroupeFrontController extends AbstractController
{
    /**
     * @Route("/groupe/front", name="groupe_front")
     */
    public function index()
    {
        return $this->render('groupe_front/index.html.twig', [
            'controller_name' => 'GroupeFrontController',
        ]);
    }
}
