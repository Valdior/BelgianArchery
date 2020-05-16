<?php

namespace App\Controller;

use App\Entity\Tournament;
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

            return $this->redirectToRoute('tournament_show', ['slug' => $participant->getPeloton()->getTournament()->getSlug()]);
        }

        return $this->render('participant/edit.html.twig', [
            'participant' => $participant,
            'tournament' => $participant->getPeloton()->getTournament(),
            'form' => $form->createView(),
        ]);
    }
}
 