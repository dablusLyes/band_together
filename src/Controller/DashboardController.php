<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("admin/", name="dashboard")
     */
    public function index()
    {
        return $this->render('dashboard.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
