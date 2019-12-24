<?php

namespace App\Repository;

use App\Entity\ArcherCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ArcherCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArcherCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArcherCategory[]    findAll()
 * @method ArcherCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArcherCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArcherCategory::class);
    }

    // /**
    //  * @return ArcherCategory[] Returns an array of ArcherCategory objects
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
    public function findOneBySomeField($value): ?ArcherCategory
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
