<?php

namespace App\Controller;

use App\Entity\Comptable;
use App\Form\ComptableType;
use App\Repository\ComptableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/comptable")
 */
class ComptableController extends AbstractController
{
    /**
     * @Route("/", name="comptable_index", methods={"GET"})
     */
    public function index(ComptableRepository $comptableRepository): Response
    {
        return $this->render('comptable/index.html.twig', [
            'comptables' => $comptableRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="comptable_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $comptable = new Comptable();
        $form = $this->createForm(ComptableType::class, $comptable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comptable);
            $entityManager->flush();

            return $this->redirectToRoute('comptable_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('comptable/new.html.twig', [
            'comptable' => $comptable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comptable_show", methods={"GET"})
     */
    public function show(Comptable $comptable): Response
    {
        return $this->render('comptable/show.html.twig', [
            'comptable' => $comptable,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="comptable_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Comptable $comptable): Response
    {
        $form = $this->createForm(ComptableType::class, $comptable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comptable_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('comptable/edit.html.twig', [
            'comptable' => $comptable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comptable_delete", methods={"POST"})
     */
    public function delete(Request $request, Comptable $comptable): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comptable->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comptable);
            $entityManager->flush();
        }

        return $this->redirectToRoute('comptable_index', [], Response::HTTP_SEE_OTHER);
    }
}
