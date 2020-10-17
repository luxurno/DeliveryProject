<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Repository;

use App\Bundle\ImportDelivery\Entity\ImportDelivery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImportDelivery|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImportDelivery|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImportDelivery[]    findAll()
 * @method ImportDelivery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImportDeliveryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImportDelivery::class);
    }

}