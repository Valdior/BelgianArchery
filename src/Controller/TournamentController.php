<?php

namespace App\Controller;

use App\Entity\Tournament;
use App\Form\TournamentType;
use App\Entity\TournamentSearch;
use App\Form\TournamentSearchType;
use App\Repository\TournamentRepository;
use App\Repository\ParticipantRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;



/**
 * @Route("/tournament")
 */
class TournamentController extends AbstractController
{
    /**
     * @Route("/", name="tournament_index", methods={"GET"})
     */
    public function index(TournamentRepository $repo, Request $request, PaginatorInterface $paginator): Response
    {
        $search = new TournamentSearch();
        $form = $this->createForm(TournamentSearchType::class, $search);
        $form->handleRequest($request);


        $tournaments = $paginator->paginate(
            $repo->agendas($search), 
            $request->query->getInt('page', 1),
            5);



        return $this->render('tournament/index.html.twig', [
            'current_menu' => 'tournament',
            'tournaments' => $tournaments,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/new", name="tournament_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tournament = new Tournament();
        $form = $this->createForm(TournamentType::class, $tournament);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tournament);
            $entityManager->flush();

            return $this->redirectToRoute('tournament_index');
        }

        return $this->render('tournament/new.html.twig', [
            'current_menu' => 'tournament',
            'tournament' => $tournament,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="tournament_show", methods={"GET"})
     */
    public function show(Tournament $tournament): Response
    {
        return $this->render('tournament/show.html.twig', [
            'current_menu' => 'tournament',
            'tournament' => $tournament,
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="tournament_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tournament $tournament): Response
    {
        $form = $this->createForm(TournamentType::class, $tournament);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tournament_index');
        }

        return $this->render('tournament/edit.html.twig', [
            'current_menu' => 'tournament',
            'tournament' => $tournament,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="tournament_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Tournament $tournament): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tournament->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tournament);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tournament_index');
    }

    /**
     * @Route("/{slug}/ranking", name="tournament_ranking", methods="GET")
     */
    public function ranking(Tournament $tournament, ParticipantRepository $repo)
    {
        $participants = $repo->ranking($tournament->getId());
        return $this->render('tournament/ranking.html.twig', ['participants' => $participants]);
    }
}
