<?php

namespace App\Service;

use App\Entity\Archer;
use App\Entity\Peloton;
use App\Repository\ParticipantRepository;
use Doctrine\ORM\EntityManagerInterface;

class ParticipationHelper
{
    /**
     * @return ParticipantRepository
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

    public function isAlreadyRegistered(Archer $archer, Peloton $peloton)
    {
        return $this->repo->isAlreadyRegistered($archer, $peloton);
    }

    public function cancelParticipation(Archer $archer, Peloton $peloton)
    {
        if($this->isAlreadyRegistered($archer, $peloton))
        {
            $participant = $this->repo->getParticipant($archer, $peloton);
            $this->em->remove($participant);
            $this->em->flush();            
        }
    }
}