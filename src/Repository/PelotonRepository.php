<?php

namespace App\Repository;

use App\Entity\Peloton;
use App\Entity\Participant;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Peloton|null find($id, $lockMode = null, $lockVersion = null)
 * @method Peloton|null findOneBy(array $criteria, array $orderBy = null)
 * @method Peloton[]    findAll()
 * @method Peloton[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PelotonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Peloton::class);
    }    
}
