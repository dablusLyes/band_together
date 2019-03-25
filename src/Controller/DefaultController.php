<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/news", name="news")
     */
    public function news()
    {
        return $this->render('default/news.html.twig', [

        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('default/contact.html.twig', [

        ]);
    }

    /**
     * @Route("/apropos", name="about")
     */
    public function about()
    {
        return $this->render('default/about.html.twig', [

        ]);
    }
}
