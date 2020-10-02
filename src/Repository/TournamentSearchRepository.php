<?php

namespace App\Repository;

use App\Entity\TournamentSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TournamentSearch|null find($id, $lockMode = null, $lockVersion = null)
 * @method TournamentSearch|null findOneBy(array $criteria, array $orderBy = null)
 * @method TournamentSearch[]    findAll()
 * @method TournamentSearch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TournamentSearchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TournamentSearch::class);
    }

    // /**
    //  * @return TournamentSearch[] Returns an array of TournamentSearch objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TournamentSearch
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
