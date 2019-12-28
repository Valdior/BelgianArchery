<?php

namespace App\Controller;

use App\Entity\Club;
use App\Entity\Archer;
use App\Entity\Affiliate;
use App\Form\AffiliateType;
use App\Service\AffiliationHelper;
use App\Repository\AffiliateRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/affiliate")
 */
class AffiliateController extends AbstractController
{
    /**
     * @Route("/{id}/new", name="archer_affiliation", methods="GET|POST")
     */
    public function affiliateNew(Request $request, Archer $archer, AffiliationHelper $helper): Response
    {
        $affiliate = new Affiliate();
        $affiliate->setArcher($archer);
        // TODO: Vérifié si c'est sa 1er affiliation
        //      Vérifié si l'utilisateur n'a pas arreter avant de recommencer
        //      Sinon il faut cloturer ces autres affialiations
        
        $form = $this->createForm(AffiliateType::class, $affiliate, [
            'disabled_archer' => true,
        ]);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $helper->TransfertArcher($affiliate);

            $em = $this->getDoctrine()->getManager();
            $em->persist($affiliate);
            $em->flush();
            return $this->redirectToRoute('archer_show', ['id' => $archer->getId()]);
        }

        return $this->render('affiliate/new.html.twig', [
            'current_menu' => 'affiliate', 
            'affiliate' => $affiliate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="archer_affiliation_edit", methods="GET|POST")
     */
    public function affiliateEdit(Request $request, Archer $archer): Response
    {
        $form = $this->createForm(AffiliateType::class, $archer);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('archer_affiliation_edit', ['id' => $archer->getId()]);
        }

        return $this->render('archer/edit.html.twig', [
            'current_menu' => 'archer', 
            'archer' => $archer,
            'form' => $form->createView(),
        ]);

        return $this->redirectToRoute('archer_show', ['id' => $archer->getId()]);
    }

    /**
     * @Route("/{id}/stop", name="archer_affiliation_stop", methods="GET")
     */
    public function affiliateDisable(Request $request, Archer $archer, AffiliationHelper $helper): Response
    {
        $this->denyAccessUnlessGranted('ROLE_OWNER_CLUB');
        $helper->DisableAffiliation($archer);

        return $this->redirectToRoute('archer_show', ['id' => $archer->getId()]);
    }
}
