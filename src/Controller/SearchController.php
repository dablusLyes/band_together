<?php

namespace App\Controller;


use App\Entity\Departements;
use App\Entity\Instruments;
use App\Entity\Search;
use App\Form\SearchUser;
use App\Repository\SearchUserEntityRepository;
use App\Repository\UserRepository;
use App\Repository\InstrumentsRepository;
use App\Repository\DepartementsRepository;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{


    /**
     * @Route("/recherche", name="search", methods={"GET","POST"})
     */

    public function searchController(Request $request, UserRepository $userRepository, InstrumentsRepository $repoinstru, DepartementsRepository $repodep)

    {

        // $departements = new Departements();
        // $instruments = new Instruments();
        $search = new Search();
        $user = $this->getUser();
        $users = array();


        if (!$user) { throw $this->createNotFoundException('The user does not exist');}


        $form = $this->createForm(SearchUser::class, $search);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          $dep  = $form['departements']->getData();
          $inst = $form['instruments']->getData();


            if (!empty($dep) && !empty($inst)){

                $searchdepartement = $repodep->find($dep->getId());
                $searchinstru = $repoinstru->find($inst->getId());
                $users = $userRepository->getUserInstruAndDepartement($searchinstru,$searchdepartement);
        
            } elseif ( !empty($dep) ){
                $searchdepartement = $repodep->find($dep->getId());
                $users = $searchdepartement->getUsers();
            } elseif(!empty($inst)){
                //$users = $searchinstru->getUsers;
                $searchinstru = $repoinstru->find($inst->getId());
                $users = $searchinstru->getUsers();
            }
        }

        // remi
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
            'lastUsers' => $lastUsers,
            'users' => $users,
        ]);
    }
}
