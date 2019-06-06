<?php

namespace App\Controller;


use App\Entity\Search;
use App\Form\SearchUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class SearchController extends AbstractController
{


    /**
     * @Route("/recherche", name="search", methods={"GET","POST"})
     */
    public function searchController(Request $request, UserRepository $userRepository)
    {

        $search = new Search();
        $user = $this->getUser();
        if (!$user) { throw $this->createNotFoundException('The user does not exist');}

        $form = $this->createForm(SearchUser::class, $search);
        $form->handleRequest($request);

        //  if departement is set in user profil, that queries the users around him, otherwise that queries the last registered users
        if( $user->getDepartement() != Null){
            $userDepartement = $user->getDepartement();
            $lastUsers = $userRepository->findUsersAround($userDepartement);
        } else {
            $lastUsers = $userRepository->findLastUsers();
        }
        
        return $this->render('search/index.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'lastUsers' => $lastUsers

        ]);
    }
}
