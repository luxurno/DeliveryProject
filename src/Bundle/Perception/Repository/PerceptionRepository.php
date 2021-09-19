<?php

declare(strict_types=1);

namespace App\Bundle\Perception\Repository;

use App\Bundle\Perception\Entity\Perception;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Perception|null find($id, $lockMode = null, $lockVersion = null)
 * @method Perception|null findOneBy(array $criteria, array $orderBy = null)
 * @method Perception[]    findAll()
 * @method Perception[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerceptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Perception::class);
    }
}
