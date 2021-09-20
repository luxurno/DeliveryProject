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

    public function provideNearByLatAndLng(
        int $importId,
        string $latitude,
        string $longitude
    ): array
    {
        $conn = $this->getEntityManager()
            ->getConnection();

        $sql = '
            SELECT `id`, `capacity`, `weight`, `postal_code` as `postal`,
                   `city`, `street`, `number`, NULL as `house`,
                   (acos(sin(:latitude) * sin(`lat`) + 
                    cos(:latitude) * cos(`lat`) * 
                    cos(`lng` - (:longitude))) * 6371)
                   as `distance`
            FROM import_delivery as idt
            WHERE `import_id` = :importId AND `route_id` IS NULL
            ORDER BY `distance` ASC
            LIMIT 50
            ';

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':latitude' => $latitude,
            ':longitude' => $longitude,
            ':importId' => $importId,
        ]);

        return $stmt->fetchAll();
    }

    public function provideNearByLatAndLngWithRoutes(
        int $importId,
        string $latitude,
        string $longitude
    ): array
    {
        $conn = $this->getEntityManager()
            ->getConnection();

        $sql = '
            SELECT `idt`.`id`, `idt`.`capacity`, `idt`.`weight`, `idt`.`postal_code` as `postal`,
                   `idt`.`city`, `idt`.`street`, `idt`.`number`, NULL as `house`,
                   (acos(sin(:latitude) * sin(`lat`) + 
                    cos(:latitude) * cos(`lat`) * 
                    cos(`lng` - (:longitude))) * 6371)
                   as `distance`,
                   `r`.`driver_id`, `idt`.`lat`, `idt`.`lng`
            FROM import_delivery as `idt`
            RIGHT JOIN `route` as `r` ON `r`.`id` = `idt`.`route_id`
            WHERE `import_id` = :importId
            ORDER BY `distance` ASC
            LIMIT 50
            ';

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':latitude' => $latitude,
            ':longitude' => $longitude,
            ':importId' => $importId,
        ]);

        return $stmt->fetchAll();
    }
}
