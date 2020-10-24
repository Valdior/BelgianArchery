<?php

namespace App\Controller;

use App\Entity\Peloton;
use App\Form\PelotonType;
use App\Entity\Tournament;
use App\Entity\Participant;
use App\Form\ParticipantType;
use App\Repository\ParticipantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\ParticipationHelper;

/**
 * @Route("/tournament/{id_tournament}-{slug}/peloton")
 */
class PelotonController extends AbstractController
{
    /**
     * @Route("/new", name="peloton_new", methods={"GET","POST"}) 
     */
    public function new(Request $request, Tournament $tournament): Response
    {
        $peloton = new Peloton();
        $peloton->setStartTime($tournament->getStartDate());
        dump($peloton);
        $form = $this->createForm(PelotonType::class, $peloton, ['tournament' => $tournament]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $peloton->setTournament($tournament);
            $entityManager->persist($peloton);
            $entityManager->flush();

            $this->addFlash('success', 'Création d\'un nouveau peloton pour la compétition');

            return $this->redirectToRoute('tournament_show', ['id' => $tournament->getId(), 'slug' => $tournament->getSlug()]);
        }

        return $this->render('peloton/new.html.twig', [
            'tournament' => $tournament,
            'peloton' => $peloton,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="peloton_show", methods={"GET"})
     */
    public function show(Peloton $peloton, ParticipationHelper $helper): Response
    {
        $user = $this->getUser();
        return $this->render('peloton/show.html.twig', [
            'peloton' => $peloton,
            'isAlreadyRegistered' => $user == null ? false : $helper->isAlreadyRegistered($user->getArcher(), $peloton)            
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

            return $this->redirectToRoute('peloton_show', ['id_tournament' => $peloton->getTournament()->getId(),
                                                            'slug' => $peloton->getTournament()->getSlug(), 
                                                            'id' => $peloton->getId()]);
        }

        return $this->render('peloton/edit.html.twig', [
            'peloton' => $peloton,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="peloton_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Tournament $tournament, Peloton $peloton): Response
    {
        if ($this->isCsrfTokenValid('delete'.$peloton->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($peloton);
            $entityManager->flush();
            
            $this->addFlash('success', 'Le peloton a bien été supprimé');
        }

        return $this->redirectToRoute('tournament_show', ['id' => $tournament->getId(), 'slug' => $tournament->getSlug()]);
    }

    /**
     * @Route("/{id}/register", name="peloton_register", methods="GET|POST")
     */
    public function register(Request $request, Peloton $peloton, ParticipationHelper $helper): Response
    {
        if($helper->isAlreadyRegistered($this->getUser()->getArcher(), $peloton))
        {
            $this->addFlash('warning', 'Vous êtes déjà inscrit à ce peloton');
            return $this->redirectToRoute('tournament_show', ['id' => $peloton->getTournament()->getId(), 'slug' => $peloton->getTournament()->getSlug()]);
        }

        $participant = new Participant();
        $participant->setPeloton($peloton);
        $participant->setArcher($this->getUser()->getArcher());
        $participant->setCategory($this->getUser()->getArcher()->getDefaultCategory());
        $form = $this->createForm(ParticipantType::class, $participant, ['user' => $this->getUser()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { 
            $em = $this->getDoctrine()->getManager();
            $em->persist($participant);
            $em->flush();

            $this->addFlash('success', 'Vous avez été inscrit à ce peloton');

            return $this->redirectToRoute('tournament_show', ['id' => $peloton->getTournament()->getId(), 'slug' => $peloton->getTournament()->getSlug()]);
        }        

        return $this->render('participant/register.html.twig', [
            'participant' => $participant,
            'peloton' => $peloton,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/unregister", name="peloton_unregister", methods="GET|POST")
     */
    public function unregister(Request $request, Peloton $peloton, ParticipationHelper $helper): Response
    {
        if(!$helper->isAlreadyRegistered($this->getUser()->getArcher(), $peloton))
        {
            $this->addFlash('warning', 'Vous ne pouvez pas vous désincrire à un peloton auquel vous n\'êtes pas déjà inscrit');
            return $this->redirectToRoute('tournament_show', ['id' => $peloton->getTournament()->getId(), 'slug' => $peloton->getTournament()->getSlug()]);
        }

        $helper->cancelParticipation($this->getUser()->getArcher(), $peloton);
        $this->addFlash('success', 'Vous avez bien été désinscrit du peloton');

        return $this->redirectToRoute('tournament_show', ['id' => $peloton->getTournament()->getId(), 'slug' => $peloton->getTournament()->getSlug()]);
    }

    /**
     * @Route("/{id}/registerAnother", name="peloton_register_another", methods="GET|POST")
     */
    public function registerAnother(Request $request, Peloton $peloton, ParticipationHelper $helper): Response
    {
        if($helper->isAlreadyRegistered($this->getUser()->getArcher(), $peloton))
        {
            return $this->redirectToRoute('tournament_show', ['id' => $peloton->getTournament()->getId(), 'slug' => $peloton->getTournament()->getSlug()]);
        }

        $participant = new Participant();
        $participant->setPeloton($peloton);
        $participant->setArcher($this->getUser()->getArcher());
        $participant->setCategory($this->getUser()->getArcher()->getDefaultCategory());
        $form = $this->createForm(ParticipantType::class, $participant, ['user' => $this->getUser()
                                                                        , 'disabled_archer' => !in_array('ROLE_ADMIN', $this->getUser()->getRoles())
                                                                        ]);
                                                                        // , 'is_already_registered' => $participantRepository->isAlreadyRegistered($participant)]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { 
            // TODO : message à améliorer => Vous avez été inscrit au Peloton Ou si admin, le nom de la personne inscrite
            // if($value)
            // {
            //     $this->addFlash('warning', '"' . $participant->getArcher()->getFullname() . '" est déjà inscrit à ce peloton');
            // }
            // else
            // {
                $em = $this->getDoctrine()->getManager();
                $em->persist($participant);
                $em->flush();

                $this->addFlash('success', '"' . $participant->getArcher()->getFullname() . '" a été inscrit à ce peloton');
            // }

            return $this->redirectToRoute('tournament_show', ['id' => $peloton->getTournament()->getId(), 'slug' => $peloton->getTournament()->getSlug()]);
        }        

        return $this->render('participant/register.html.twig', [
            'participant' => $participant,
            'peloton' => $peloton,
            'form' => $form->createView(),
        ]);
    }
}
