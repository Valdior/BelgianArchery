<?php

namespace App\Repository;

use App\Entity\Archer;
use App\Entity\Participant;
use App\Entity\Peloton;
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
     * @return boolean Checks whether the participant is already registered in the peleton
     */
    public function getParticipant(Archer $archer, Peloton $peloton)
    {
        $result = $this->createQueryBuilder('p')
                    ->andWhere('p.archer = :archer')
                        ->setParameter('archer', $archer)
                    ->andWhere('p.peloton = :peloton')
                        ->setParameter('peloton', $peloton)
                    ->getQuery()
                    ->getOneOrNullResult()
                ;

        return $result;
    }

    /**
     * @var boolean
     * @return boolean Checks whether the participant is already registered in the peleton
     */
    public function isAlreadyRegistered(Archer $archer, Peloton $peloton)
    {
        $result = $this->createQueryBuilder('p')
                    ->andWhere('p.archer = :archer')
                        ->setParameter('archer', $archer)
                    ->andWhere('p.peloton = :peloton')
                        ->setParameter('peloton', $peloton)
                    ->getQuery()
                    ->getScalarResult()
                ;

        return count($result) > 0;
    }
}
