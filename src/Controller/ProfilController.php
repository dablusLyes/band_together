<?php

namespace App\Controller;



use App\Form\ProfileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profile", methods={"GET","POST"})
     */
    public function index( Request $request )
    {
        $user = $this->getUser();

        if(!$user) {
            throw $this->createNotFoundException('The user does not exist');
        }

        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */

            $file = $form['avatar']->getData();

            if(isset($file)){
                  $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

                  // Move the file to the directory where brochures are stored
                  try {
                      $file->move(
                          $this->getParameter('image'),
                          $fileName
                      );
                  } catch (FileException $e) {
                      // ... handle exception if something happens during file upload
                  }

                  $user->setAvatar($fileName);

                  $this->getDoctrine()->getManager()->flush();
                  return $this->redirectToRoute('profile');
              }
            }

<<<<<<< HEAD
=======
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Votre profil à bien été modifié !');
            return $this->redirectToRoute('profile');
        }
>>>>>>> aec417ead4e577da9662ae490793b4cff26a0425

        return $this->render('profil/index.html.twig', [
            'user' => $user,
            'profileForm' => $form->createView()
        ]);
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}
