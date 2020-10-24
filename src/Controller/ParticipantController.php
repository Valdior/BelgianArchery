<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\ParticipantType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/tournament/{slug}/participant", name="participant_")
 */
class ParticipantController extends AbstractController
{
    /**
     * @Route("/{id}/edit", name="edit")
     */
    public function edit(Request $request, Participant $participant)
    {
        $form = $this->createForm(ParticipantType::class, $participant, array('user' => $this->getUser()));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $tournament = $participant->getPeloton()->getTournament();

            return $this->redirectToRoute('tournament_show', ['id' => $tournament->getId(),
                                                            'slug' => $tournament->getSlug()]);
        }

        return $this->render('participant/edit.html.twig', [
            'participant' => $participant,
            'tournament' => $participant->getPeloton()->getTournament(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/unregister", name="unregister", methods={"DELETE"})
     */
    public function unregister(Request $request, Participant $participant)
    {
        if ($this->isCsrfTokenValid('unregister'.$participant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($participant);
            $entityManager->flush();
            
            $this->addFlash('success', 'Vous vous êtes désinscrit du peloton');
        }
        
        return $this->redirectToRoute('peloton_show', ['id_tournament' => $participant->getPeloton()->getTournament()->getId(), 
                                                        'slug' => $participant->getPeloton()->getTournament()->getSlug(),
                                                        'id' => $participant->getPeloton()->getId() ]);
    }
}
 