<?php

namespace App\Service;

use App\Entity\Archer;
use Doctrine\ORM\EntityManagerInterface;

class ParticipationHelper
{
    /**
     * @return AffiliateRepository
     */
    private $repo;

    /**
     * @return EntityManagerInterface
     */
    private $em;

    public function __construct(ParticipantRepository $repo, EntityManagerInterface $em)
    {
        $this->repo = $repo;
        $this->em = $em;
    }

    
}