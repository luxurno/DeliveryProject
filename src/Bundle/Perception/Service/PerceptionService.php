<?php

declare(strict_types = 1);

namespace App\Bundle\Perception\Service;

use App\Bundle\Driver\Repository\DriverRepository;
use App\Bundle\Perception\DTO\PerceptionDTO;
use App\Bundle\Perception\Entity\Perception;
use App\Bundle\Perception\Factory\PerceptionFactory;
use App\Bundle\Perception\Formatter\PerceptionAddressFormatter;
use App\Bundle\Perception\Producer\PerceptionProducer;
use App\Bundle\Perception\Repository\PerceptionRepository;
use App\Bundle\User\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PerceptionService
{
    /** @var DriverRepository */
    private $driverRepository;
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var UserRepository */
    private $userRepository;
    /** @var PerceptionFactory */
    private $perceptionFactory;
    /** @var PerceptionProducer */
    private $perceptionProducer;
    /** @var PerceptionRepository */
    private $perceptionRepository;

    public function __construct(
        DriverRepository $driverRepository,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        PerceptionFactory $perceptionFactory,
        PerceptionProducer $perceptionProducer,
        PerceptionRepository $perceptionRepository
    )
    {
        $this->driverRepository = $driverRepository;
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
        $this->perceptionFactory = $perceptionFactory;
        $this->perceptionProducer = $perceptionProducer;
        $this->perceptionRepository = $perceptionRepository;
    }

    public function getPerception(int $perceptionId): ?Perception
    {
        return $this->perceptionRepository->findOneBy(['id' => $perceptionId]);
    }

    public function editPerception(int $perceptionId, int $driverId): void
    {
        $perception = $this->perceptionRepository->findOneBy(['id' => $perceptionId]);
        if (null === $perception) {
            throw new NotFoundHttpException();
        }

        $driver = $this->driverRepository->findOneBy(['id' => $driverId]);
        if (null === $driver) {
            throw new NotFoundHttpException();
        }

        $perception->setDriver($driver);
        $driver->setPerceptions($perception);

        $this->entityManager->persist($perception);
        $this->entityManager->persist($driver);
        $this->entityManager->flush();
    }

    public function savePerception(array $data): Perception
    {
        $perceptionDTO = PerceptionDTO::create($data);

        $formatted = PerceptionAddressFormatter::format($perceptionDTO);
        $perceptionDTO->setFormatted($formatted);

        $user = $this->userRepository->findOneBy(['id' => $data['userId']]);

        if (null === $user) {
            throw new NotFoundHttpException();
        }
        $perception = $this->perceptionFactory->factory();

        $perception->setUser($user);

        $perception->setCountry($perceptionDTO->getCountry());
        $perception->setVoivodeship($perceptionDTO->getVoivodeship());
        $perception->setPostalCode($perceptionDTO->getPostalCode());
        $perception->setCity($perceptionDTO->getCity());
        $perception->setStreet($perceptionDTO->getStreet());
        $perception->setNumber($perceptionDTO->getNumber());
        $perception->setCapacity($perceptionDTO->getCapacity());
        $perception->setWeight($perceptionDTO->getWeight());
        $perception->setFormatted($formatted);
        $perception->updateTimestamps();

        $this->perceptionProducer->addQueue($perceptionDTO);

        $this->entityManager->persist($perception);
        $this->entityManager->flush();

        $perception = $this->perceptionRepository->findOneBy(['formatted' => $perceptionDTO->getFormatted()]);

        return $perception;
    }
}
