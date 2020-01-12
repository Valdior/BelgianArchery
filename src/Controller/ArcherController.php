<?php

namespace App\Controller;

use App\Entity\Archer;
use App\Form\ArcherType;
use App\Repository\ArcherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/archer")
 */
class ArcherController extends AbstractController
{
    /**
     * @Route("/", name="archer_index", methods={"GET"})
     */
    public function index(ArcherRepository $archerRepository): Response
    {
        return $this->render('archer/index.html.twig', [
            'archers' => $archerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="archer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $archer = new Archer();
        $form = $this->createForm(ArcherType::class, $archer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // TODO : Comment faire pour l'admin ? 
            $user = $this->getUser();
            $user->setArcher($archer);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($archer);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('archer_index');
        }

        return $this->render('archer/new.html.twig', [
            'archer' => $archer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="archer_show", methods={"GET"})
     */
    public function show(Archer $archer): Response
    {
        return $this->render('archer/show.html.twig', [
            'archer' => $archer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="archer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Archer $archer): Response
    {
        $form = $this->createForm(ArcherType::class, $archer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', '"' . $archer->getFullname() . '" a été modifié avec succes');
            return $this->redirectToRoute('archer_show', ['id' => $archer->getId()]);
        }

        return $this->render('archer/edit.html.twig', [
            'archer' => $archer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="archer_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Archer $archer): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($this->isCsrfTokenValid('delete'.$archer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($archer);
            $entityManager->flush();
            $this->addFlash('success', '"' . $archer->getFullname() . '" a été supprimé avec succes');
        }

        return $this->redirectToRoute('archer_index');
    }
}
