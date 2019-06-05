<?php

namespace App\Controller;


use App\Entity\Search;
use App\Form\SearchUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{


    /**
     * @Route("/recherche", name="search", methods={"GET","POST"})
     */
    public function searchController(Request $request )
    {

        $search = new Search();

        $user = $this->getUser();
//        if(!$user) {
//            throw $this->createNotFoundException('The user does not exist');
//        }
        $form = $this->createForm(SearchUser::class, $search);
        $form->handleRequest($request);



        return $this->render('search/index.html.twig', [
            'user' => $user,
            'form' => $form->createView(),

        ]);
    }
}