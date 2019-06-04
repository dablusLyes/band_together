<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index( UserRepository $userRepository )
    {
        $lastUsers = $userRepository->findByLastUserWithDepartement();
        

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'lastUsers' => $lastUsers
        ]);
    }

}
