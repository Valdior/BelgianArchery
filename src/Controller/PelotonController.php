<?php

namespace App\Controller;

use App\Entity\Peloton;
use App\Form\PelotonType;
use App\Entity\Tournament;
use App\Entity\Participant;
use App\Form\ParticipantType;
use App\Repository\PelotonRepository;
use App\Repository\ParticipantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/tournament/{tournament}/peloton")
 */
class PelotonController extends AbstractController
{
    /**
     * @Route("/", name="peloton_index", methods={"GET"})
     */
    public function index(PelotonRepository $pelotonRepository): Response
    {
        return $this->render('peloton/index.html.twig', [
            'pelotons' => $pelotonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="peloton_new", methods={"GET","POST"}) 
     */
    public function new(Request $request): Response
    {
        $peloton = new Peloton();
        $form = $this->createForm(PelotonType::class, $peloton);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($peloton);
            $entityManager->flush();

            return $this->redirectToRoute('peloton_index');
        }

        return $this->render('peloton/new.html.twig', [
            'peloton' => $peloton,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="peloton_show", methods={"GET"})
     */
    public function show(Peloton $peloton): Response
    {
        return $this->render('peloton/show.html.twig', [
            'peloton' => $peloton,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="peloton_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Peloton $peloton): Response
    {
        $form = $this->createForm(PelotonType::class, $peloton);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('peloton_index');
        }

        return $this->render('peloton/edit.html.twig', [
            'peloton' => $peloton,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="peloton_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Peloton $peloton): Response
    {
        if ($this->isCsrfTokenValid('delete'.$peloton->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($peloton);
            $entityManager->flush();
        }

        return $this->redirectToRoute('peloton_index');
    }

    /**
     * @Route("/{id}/register", name="peloton_register", methods="GET|POST")
     */
    public function register(Request $request, Tournament $tournament, Peloton $peloton, ParticipantRepository $participantRepository): Response
    {
        $participant = new Participant();
        $participant->setPeloton($peloton);
        $participant->setArcher($this->getUser()->getArcher());
        $form = $this->createForm(ParticipantType::class, $participant, ['user' => $this->getUser(), 'disabled_archer' => !in_array('ROLE_ADMIN', $this->getUser()->getRoles())]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { 
            $value = $participantRepository->isAlreadyRegistered($participant);

            if($value)
            {
                $this->addFlash('warning', '"' . $participant->getArcher()->getFullname() . '" a déjà été inscrit à ce peloton');
            }
            else
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($participant);
                $em->flush();

                $this->addFlash('success', '"' . $participant->getArcher()->getFullname() . '" a été inscrit à ce peloton');                
            }

            return $this->redirectToRoute('tournament_show', ['id' => $tournament->getId()]);
        }        

        return $this->render('participant/register.html.twig', [
            'participant' => $participant,
            'peloton' => $peloton,
            'tournament' => $tournament,
            'form' => $form->createView(),
        ]);
    }
}
