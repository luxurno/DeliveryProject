<?php

declare(strict_types = 1);

namespace App\Service;

use App\Repository\DriverRepository;
use App\ValueObject\DriverValueObject;
use Doctrine\ORM\EntityManagerInterface;

class DriverService
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var DriverRepository */
    private $driverRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        DriverRepository $driverRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->driverRepository = $driverRepository;
    }

    public function saveDriverConfig(DriverValueObject $driverVO): void
    {
        $driver = $this->driverRepository->findOneBy(['id' => $driverVO->getId()]);

        $driver->setHeight($driverVO->getHeight());
        $driver->setWidth($driverVO->getWidth());
        $driver->setCapacity($driverVO->getCapacity());
        $driver->setAdr($driverVO->getAdr());

        $this->entityManager->persist($driver);
        $this->entityManager->flush();
    }

    public function getAllDrivers(): array
    {
         return $this->driverRepository->findAll();
    }
}
