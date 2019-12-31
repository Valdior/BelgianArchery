<?php

namespace App\Service;

use App\Entity\Archer;
use App\Entity\Affiliate;
use App\Repository\AffiliateRepository;
use Doctrine\ORM\EntityManagerInterface;

class AffiliationHelper
{
    /**
     * @var AffiliateRepository
     */
    private $repo;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(AffiliateRepository $repo, EntityManagerInterface $em)
    {
        $this->repo = $repo;
        $this->em = $em;
    }

    public function TransfertArcher(Affiliate $newAffiliate)
    {
        $oldAffiliation = $this->repo->findLastAffiliationByArcher($newAffiliate->getArcher());

        if($oldAffiliation != null)
        {
            $affiliateEnd = $newAffiliate->getAffiliateSince()
                                        ->modify('-1 day');
            $oldAffiliation->setAffiliateEnd($affiliateEnd);

            $this->em->persist($oldAffiliation);
        }
    }

    public function DisableAffiliation(Archer $archer)
    {
        $affiliation = $this->repo->findLastAffiliationByArcher($archer);

        if($affiliation != null)
        {
            $affiliation->setAffiliateEnd(new \DateTime());
            $archer->setStatus(Archer::INACTIVE);

            $this->em->persist($affiliation);
            $this->em->persist($archer);
            $this->em->flush();
        }
    }

    public function NewAffiliation(Archer $archer)
    {

    }
}