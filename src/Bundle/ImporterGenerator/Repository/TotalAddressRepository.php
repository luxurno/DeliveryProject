<?php

declare(strict_types = 1);

namespace App\Bundle\ImporterGenerator\Repository;

use App\Bundle\ImporterGenerator\Entity\TotalAddress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TotalAddress|null find($id, $lockMode = null, $lockVersion = null)
 * @method TotalAddress|null findOneBy(array $criteria, array $orderBy = null)
 * @method TotalAddress[]    findAll()
 * @method TotalAddress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TotalAddressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TotalAddress::class);
    }
}
