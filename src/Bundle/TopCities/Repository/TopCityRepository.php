<?php

declare(strict_types=1);

namespace App\Bundle\TopCities\Repository;

use App\Bundle\TopCities\Entity\TopCity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TopCity|null find($id, $lockMode = null, $lockVersion = null)
 * @method TopCity|null findOneBy(array $criteria, array $orderBy = null)
 * @method TopCity[]    findAll()
 * @method TopCity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TopCityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TopCity::class);
    }
}
