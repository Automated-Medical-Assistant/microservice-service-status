<?php

namespace App\Repository;

use App\Entity\NumberList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NumberList|null find($id, $lockMode = null, $lockVersion = null)
 * @method NumberList|null findOneBy(array $criteria, array $orderBy = null)
 * @method NumberList[]    findAll()
 * @method NumberList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NumberListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NumberList::class);
    }
}
