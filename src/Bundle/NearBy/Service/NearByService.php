<?php

declare(strict_types=1);

namespace App\Bundle\NearBy\Service;

use App\Bundle\Driver\Enum\DriverAvailable;
use App\Bundle\Driver\Factory\DriverDTOFactory;
use App\Bundle\Driver\Repository\DriverRepository;
use App\Bundle\Import\Repository\ImportRepository;
use App\Bundle\ImportDelivery\Provider\ImportDeliveryProvider;
use App\Bundle\NearBy\Filter\NearByFilterArea;
use App\Bundle\NearBy\Filter\NearByFilterDrivers;
use App\Bundle\Perception\Repository\PerceptionRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NearByService
{
    /** @var DriverDTOFactory */
    private $driverDTOFactory;
    /** @var DriverRepository */
    private $driverRepository;
    /** @var ImportDeliveryProvider */
    private $importDeliveryProvider;
    /** @var ImportRepository */
    private $importRepository;
    /** @var NearByFilterArea */
    private $nearByFilterArea;
    /** @var NearByFilterDrivers */
    private $nearByFilterDrivers;
    /** @var PerceptionRepository */
    private $perceptionRepository;

    public function __construct(
        DriverDTOFactory $driverDTOFactory,
        DriverRepository $driverRepository,
        ImportDeliveryProvider $importDeliveryProvider,
        ImportRepository $importRepository,
        NearByFilterArea $nearByFilterArea,
        NearByFilterDrivers $nearByFilterDrivers,
        PerceptionRepository $perceptionRepository
    )
    {
        $this->driverDTOFactory = $driverDTOFactory;
        $this->driverRepository = $driverRepository;
        $this->importDeliveryProvider = $importDeliveryProvider;
        $this->importRepository = $importRepository;
        $this->nearByFilterArea = $nearByFilterArea;
        $this->nearByFilterDrivers = $nearByFilterDrivers;
        $this->perceptionRepository = $perceptionRepository;
    }

    public function getNearBy(int $userId, int $perceptionId): array
    {
        $perception = $this->perceptionRepository->findOneBy(['id' => $perceptionId]);

        if (null === $perception) {
            throw new NotFoundHttpException();
        }

        $import = $this->importRepository->findOneBy(['importDate' => (new \DateTime())]);

        if (null === $import) {
            throw new NotFoundHttpException();
        }

        $nearBy = $this->importDeliveryProvider->provideNearByLatAndLngWithRoutes(
            $import->getId(),
            $perception->getLat(),
            $perception->getLng()
        );

        $drivers = $this->nearByFilterDrivers->filter($nearBy);

        $nearBys = [];
        foreach ($drivers as $driverId) {
            $driver = $this->driverRepository->findOneBy(['id' => $driverId]);
            $area = $this->nearByFilterArea->filter($nearBy, $driverId);

            $driverDTO = $this->driverDTOFactory->factory();

            $driverDTO->setId((int) $driverId);
            $driverDTO->setName($driver->getName());
            $driverDTO->setImage($driver->getImage());
            $driverDTO->setHeight($driver->getHeight());
            $driverDTO->setWidth($driver->getWidth());
            $driverDTO->setCapacity($driver->getCapacity());
            $driverDTO->setAdr($driver->getAdr());
            $driverDTO->setArea($area);

            $nearBys[] = $driverDTO;
        }

        return $nearBys;
    }
}
