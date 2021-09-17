<?php

declare(strict_types = 1);

namespace App\Service;

use App\Bundle\User\Repository\UserRepository;
use App\Entity\Driver;
use App\Enum\AdrEnum;
use App\Repository\DriverRepository;
use App\ValueObject\DriverValueObject;
use Doctrine\ORM\EntityManagerInterface;

class DriverService
{
    /** @var DriverRepository */
    private $driverRepository;
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var UserRepository */
    private $userRepository;

    public function __construct(
        DriverRepository $driverRepository,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository
    )
    {
        $this->driverRepository = $driverRepository;
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
    }

    public function saveDriverConfig(DriverValueObject $driverVO): void
    {
        $driver = $this->driverRepository->findOneBy(['id' => $driverVO->getId()]);

        $driver->setHeight($driverVO->getHeight());
        $driver->setLength($driverVO->getLength());
        $driver->setWidth($driverVO->getWidth());
        $driver->setCapacity($driverVO->getCapacity());
        $driver->setAdr($driverVO->getAdr());
        $driver->setAvailable(true);

        $this->entityManager->persist($driver);
        $this->entityManager->flush();
    }

    public function getAllDrivers(int $userId, bool $available): array
    {
        $criteria = ['user' => $userId];
        if ($available) {
            $criteria['available'] = $available;
        }

         return $this->driverRepository->findBy($criteria);
    }

    public function createDriver(DriverValueObject $driverValueObject): void
    {
        $user = $this->userRepository->findOneBy(['id' => $driverValueObject->getUserId()]);

        $driver = new Driver();

        $driver->setUser($user);
        $driver->setName($driverValueObject->getName());
        $driver->setAdr(AdrEnum::NO);

        $this->entityManager->persist($driver);
        $this->entityManager->flush();
    }

    public function deleteDriver(DriverValueObject $driverValueObject): void
    {
        $driver = $this->driverRepository->findOneBy(['id' => $driverValueObject->getId()]);

        $this->entityManager->remove($driver);
        $this->entityManager->flush();
    }
}
