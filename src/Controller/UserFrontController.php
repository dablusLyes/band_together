<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserFrontController extends AbstractController
{
    /**
     * @Route("/user/front", name="user_front")
     */
    public function index()
    {
        return $this->render('user_front/index.html.twig', [
            'controller_name' => 'UserFrontController',
        ]);
    }
}
