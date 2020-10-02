<?php

namespace App\Repository;

use App\Entity\Archer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Archer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Archer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Archer[]    findAll()
 * @method Archer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArcherRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Archer::class);
    }

    // /**
    //  * @return Archer[] Returns an array of Archer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Archer
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
