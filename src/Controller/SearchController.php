<?php

namespace App\Controller;


use App\Entity\Departements;
use App\Entity\Instruments;
use App\Entity\Search;
use App\Form\SearchUser;
use App\Repository\SearchUserEntityRepository;
use App\Repository\UserRepository;
use App\Repository\UsersInstrumentsRepository;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{


    /**
     * @Route("/recherche", name="search", methods={"GET","POST"})
     */

    public function searchController(Request $request, UserRepository $userRepository)

    {

        $departements = new Departements();
        $instruments = new Instruments();
        $search = new Search();
        $user = $this->getUser();


        if (!$user) { throw $this->createNotFoundException('The user does not exist');}


        $form = $this->createForm(SearchUser::class, $search);
        $form->handleRequest($request);

        $dep = $search->getDepartements()->getId();
        $inst= $search->getInstruments()->getId();

        if ($form->isSubmitted() && $form->isValid()) {


            if (empty($dep)&&empty($inst)){
                echo('oui');
            }elseif(!empty($dep)&&empty($inst)){

                $users =  $departements->getUsers;

            }elseif(empty($dep)&&!empty($inst)){

            }else{
                dd($search);
            }

        }
        return $this->render('search/index.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'users' => $users,
        ]);


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
