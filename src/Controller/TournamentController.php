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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
     * @Route("/{slug}-{id}", name="tournament_show", methods={"GET"}, requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Tournament $tournament, string $slug): Response
    {
        if($tournament->getSlug() !== $slug)
        {
            return $this->redirectToRoute('tournament_show', [
                'id' => $tournament->getId(),
                'slug' => $tournament->getSlug()
            ],  301);
        }

        return $this->render('tournament/show.html.twig', [
            'current_menu' => 'tournament',
            'tournament' => $tournament,
        ]);
    }

    /**
     * @Route("/{id}-{slug}/edit", name="tournament_edit", methods={"GET","POST"}, requirements={"slug": "[a-z0-9\-]*"})
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
     * @Route("/{id}-{slug}", name="tournament_delete", methods={"DELETE"}, requirements={"slug": "[a-z0-9\-]*"})
     * @IsGranted("ROLE_ADMIN", statusCode=404, message="Tournament not found")
     */
    public function delete(Request $request, Tournament $tournament): Response
    {
        $submittedToken  = $request->request->get('_token');

        if ($this->isCsrfTokenValid('delete-'.$tournament->getId(), $submittedToken)) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tournament);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tournament_index');
    }

    /**
     * @Route("/{id}-{slug}/ranking", name="tournament_ranking", methods="GET", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function ranking(Tournament $tournament, ParticipantRepository $repo)
    {
        $participants = $repo->ranking($tournament->getId());
        return $this->render('tournament/ranking.html.twig', ['participants' => $participants]);
    }

    /**
     * @Route("/agenda", name="tournament_agenda", methods="GET")
     */
    public function agenda($max = 5, $showInfo = false, TournamentRepository $repo)
    {
        $tournaments = $repo->nextTournaments($max);
        return $this->render('tournament/_agenda.html.twig', 
            ['tournaments' => $tournaments,
             'showInfo' => $showInfo]);
    }
}
