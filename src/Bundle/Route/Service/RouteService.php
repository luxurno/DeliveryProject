<?php

declare(strict_types=1);

namespace App\Bundle\Route\Service;

use App\Bundle\Driver\Enum\DriverAvailable;
use App\Bundle\Driver\Service\DriverService;
use App\Bundle\Import\Repository\ImportRepository;
use App\Bundle\ImportDelivery\Provider\ImportDeliveryProvider;
use App\Bundle\Prediction\Service\PredictionService;
use App\Bundle\Route\Assigner\RouteAssigner;
use App\Bundle\Route\Calculator\DriverCapacityCalculator;
use App\Bundle\Route\Capacity\DriverCapacity;
use App\Bundle\Route\Validator\RouteValidator;
use App\Bundle\TopCities\Repository\TopCityRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RouteService
{
    /** @var DriverCapacityCalculator */
    private $driverCapacityCalculator;
    /** @var DriverService */
    private $driverService;
    /** @var ImportDeliveryProvider */
    private $importDeliveryProvider;
    /** @var ImportRepository */
    private $importRepository;
    /** @var PredictionService */
    private $predictionService;
    /** @var RouteAssigner */
    private $routeAssigner;
    /** @var TopCityRepository */
    private $topCityRepository;

    public function __construct(
        DriverCapacityCalculator $driverCapacityCalculator,
        DriverService $driverService,
        ImportDeliveryProvider $importDeliveryProvider,
        ImportRepository $importRepository,
        PredictionService $predictionService,
        RouteAssigner $routeAssigner,
        TopCityRepository $topCityRepository
    )
    {
        $this->driverCapacityCalculator = $driverCapacityCalculator;
        $this->driverService = $driverService;
        $this->importDeliveryProvider = $importDeliveryProvider;
        $this->importRepository = $importRepository;
        $this->predictionService = $predictionService;
        $this->routeAssigner = $routeAssigner;
        $this->topCityRepository = $topCityRepository;
    }

    public function generateRouteLookup(int $userId, int $driverId, string $voivodeship = 'śląskie'): array
    {
        $driver = $this->driverService->findById($driverId);

        if (null === $driver) {
            throw new NotFoundHttpException();
        }

        $import = $this->importRepository->findOneBy([
            'importDate' => (new \DateTime()),
//            'userId' => $userId,
        ]);

        if (null === $import) {
            throw new NotFoundHttpException();
        }

        $results = $this->importDeliveryProvider->provideNearByDriverId(
            $import->getId(),
            $driverId
        );

        return $results;
    }

    public function generateRoute(int $userId, int $driverId, string $voivodeship = 'śląskie'): array
    {
        $driver = $this->driverService->findById($driverId);

        if (null === $driver) {
            throw new NotFoundHttpException();
        }
        $city = $this->predictionService->getPerceptionCity($voivodeship);

        $topCity = $this->topCityRepository->findOneBy([
            'city' => $city,
            'voivodeship' => $voivodeship,
        ]);

        if (null === $topCity) {
            throw new NotFoundHttpException();
        }

        $import = $this->importRepository->findOneBy([
            'importDate' => (new \DateTime()),
//            'userId' => $userId,
        ]);

        if (null === $import) {
            throw new NotFoundHttpException();
        }
        $capacity = $this->driverCapacityCalculator->calculate($driver);

        $results = $this->importDeliveryProvider->provideNearByLatAndLng(
            $import->getId(),
            $topCity->getLat(),
            $topCity->getLng()
        );

        DriverCapacity::setDriverCapacity($capacity);
        DriverCapacity::setDriverWeight((int) $driver->getCapacity());

        $routes = [];
        foreach ($results as $result) {
            if (RouteValidator::validate(
                (float) $result['capacity'],
                (int) $result['weight']
            )) {
                DriverCapacity::setDriverCapacity(
                    DriverCapacity::getDriverCapacity() - (float) $result['capacity']
                );
                DriverCapacity::setDriverWeight(
                    DriverCapacity::getDriverWeight() - (int) $result['weight']
                );

                $this->routeAssigner->assign($driver, $result);
                $routes[] = $result;
            }
        }
        $this->driverService->setAvailable($driverId, DriverAvailable::ROUTE_AVAILABLE);

        return $routes;
    }
}