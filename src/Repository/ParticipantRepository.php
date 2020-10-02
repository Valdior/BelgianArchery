<?php

namespace App\Repository;

use App\Entity\Participant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Participant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Participant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Participant[]    findAll()
 * @method Participant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Participant::class);
    }

    /**
     * @var Participant[]
     * @return Participant[] Returns an array of Participant objects
     */
    public function ranking($idTournament): Array
    {
        // TODO : Vérifié ce qu'il se passe lorsque qu'on a plusieurs peloton à des distances différentes 
        return $this->createQueryBuilder('p')
                    ->leftJoin('p.peloton', 'pel')
                    ->andWhere('pel.tournament = :val')
                        ->setParameter('val', $idTournament)
                    ->OrderBy('p.category', 'ASC')
                        ->addOrderBy('p.points', 'DESC')
                        ->addOrderBy('p.numberOfX', 'DESC')
                        ->addOrderBy('p.numberOfTen', 'DESC')
                        ->addOrderBy('p.numberOfNine', 'DESC')
                    ->getQuery()
                    ->getResult()
                ;
    }

    /**
     * @var boolean
     * @return boolean Checks whether the participant is already booked in the peleton
     */
    public function isAlreadyRegistered(Participant $participant)
    {
        $result = $this->createQueryBuilder('p')
                    ->andWhere('p.archer = :archer')
                        ->setParameter('archer', $participant->getArcher())
                    ->andWhere('p.peloton = :peloton')
                        ->setParameter('peloton', $participant->getPeloton())
                    ->getQuery()
                    ->getScalarResult()
                ;

        if(count($result) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
