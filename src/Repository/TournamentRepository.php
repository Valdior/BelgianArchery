<?php

namespace App\Repository;

use Doctrine\ORM;
use App\Entity\Tournament;
use App\Entity\TournamentSearch;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Tournament|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tournament|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tournament[]    findAll()
 * @method Tournament[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TournamentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tournament::class);
    }

    public function agendas(TournamentSearch $search)
    {
        $query = $this->createQueryBuilder('t');

        if($search->getType())
        {            
            $query = $query->andWhere('t.type = :type')
                            ->setParameter(':type', array_search($search->getType(), TournamentSearch::getTypeList()));
        }


        return $query->getQuery()
                        ->getResult();
    }

    public function nextTournaments($max)
    {
        $query = $this->createQueryBuilder('t')
                        ->Where('t.endDate >= :date')
                        ->setParameter(':date', new \Datetime())
                        ->setMaxResults($max)
                            ;


        return $query->getQuery()
                        ->getResult()
                    ;
    }

    // /**
    //  * @return Tournament[] Returns an array of Tournament objects
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
    public function findOneBySomeField($value): ?Tournament
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
