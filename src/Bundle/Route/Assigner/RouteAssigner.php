<?php

namespace App\Bundle\Route\Assigner;

use App\Bundle\Driver\Entity\Driver;
use App\Bundle\ImportDelivery\Repository\ImportDeliveryRepository;
use App\Bundle\Route\Factory\RouteFactory;
use Doctrine\ORM\EntityManagerInterface;

class RouteAssigner
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var ImportDeliveryRepository */
    private $importDeliveryRepository;
    /** @var RouteFactory */
    private $routeFactory;

    public function __construct(
        EntityManagerInterface $entityManager,
        ImportDeliveryRepository $importDeliveryRepository,
        RouteFactory $routeFactory
    ) {
        $this->entityManager = $entityManager;
        $this->importDeliveryRepository = $importDeliveryRepository;
        $this->routeFactory = $routeFactory;
    }

    public function assign(
        Driver $driver,
        array $row
    ): void
    {
        $route = $this->routeFactory->factory();

        $importDelivery = $this->importDeliveryRepository->findOneBy([
            'id' => (int) $row['id'],
        ]);

        $route->setImportDelivery($importDelivery);
        $importDelivery->setRoute($route);

        $route->setDriver($driver);
        $driver->setRoutes($route);

        $this->entityManager->persist($driver);
        $this->entityManager->persist($importDelivery);
        $this->entityManager->persist($route);
        $this->entityManager->flush();
    }
}
