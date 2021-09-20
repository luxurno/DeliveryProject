<?php

declare(strict_types = 1);

namespace App\Bundle\Driver\Repository;

use App\Bundle\Driver\Entity\Driver;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Driver|null find($id, $lockMode = null, $lockVersion = null)
 * @method Driver|null findOneBy(array $criteria, array $orderBy = null)
 * @method Driver[]    findAll()
 * @method Driver[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DriverRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Driver::class);
    }

    public function findDriversByUserIdAndAvailable(int $userId, ?string $available): array
    {
        $conn = $this->getEntityManager()
            ->getConnection();

        $criteria = ['userId' => $userId];
        $sql = '
            SELECT * FROM `driver`
            WHERE `user_id` = :userId
        ';

        if (null !== $available) {
            $sql .= " AND `available` = :available";
            $criteria['available'] = $available;
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute($criteria);

        return $stmt->fetchAll();
    }
}
