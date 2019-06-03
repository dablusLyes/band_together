<?php

namespace App\Controller;

use App\Entity\Instruments;
use App\Form\InstrumentsType;
use App\Repository\InstrumentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/instruments")
 */
class InstrumentsController extends AbstractController
{
    /**
     * @Route("/", name="instruments_index", methods={"GET"})
     */
    public function index(InstrumentsRepository $instrumentsRepository): Response
    {
        return $this->render('instruments/index.html.twig', [
            'instruments' => $instrumentsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="instruments_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $instrument = new Instruments();
        $form = $this->createForm(InstrumentsType::class, $instrument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($instrument);
            $entityManager->flush();

            return $this->redirectToRoute('instruments_index');
        }

        return $this->render('instruments/new.html.twig', [
            'instrument' => $instrument,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="instruments_show", methods={"GET"})
     */
    public function show(Instruments $instrument): Response
    {
        return $this->render('instruments/show.html.twig', [
            'instrument' => $instrument,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="instruments_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Instruments $instrument): Response
    {
        $form = $this->createForm(InstrumentsType::class, $instrument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('instruments_index', [
                'id' => $instrument->getId(),
            ]);
        }

        return $this->render('instruments/edit.html.twig', [
            'instrument' => $instrument,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="instruments_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Instruments $instrument): Response
    {
        if ($this->isCsrfTokenValid('delete'.$instrument->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($instrument);
            $entityManager->flush();
        }

        return $this->redirectToRoute('instruments_index');
    }
}
