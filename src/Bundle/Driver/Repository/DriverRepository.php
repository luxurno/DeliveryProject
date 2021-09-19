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

    public function findDriversByUserIdAndAvailable(int $userId, int $available): array
    {
        $conn = $this->getEntityManager()
            ->getConnection();

        $sql = '
            SELECT * FROM `driver`
            WHERE `user_id` = :userId AND `available` = :available
        ';

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'userId' => $userId,
            'available' => $available,
        ]);

        return $stmt->fetchAll();
    }
}
