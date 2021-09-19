<?php

namespace App\Bundle\TopCities\Service;

use App\Bundle\TopCities\Repository\TopCityRepository;
use App\Core\Coordinates\Builder\CoordinatesDTOBuilder;
use App\Core\Coordinates\Service\CoordinatesService;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Exception\GuzzleException;

class TopCitiesCoordinatesService
{
    /** @var CoordinatesDTOBuilder */
    private $coordinatesDTOBuilder;
    /** @var CoordinatesService */
    private $coordinatesService;
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var TopCityRepository */
    private $topCityRepository;

    public function __construct(
        CoordinatesDTOBuilder $coordinatesDTOBuilder,
        CoordinatesService $coordinatesService,
        EntityManagerInterface $entityManager,
        TopCityRepository $topCityRepository
    )
    {
        $this->coordinatesDTOBuilder = $coordinatesDTOBuilder;
        $this->coordinatesService = $coordinatesService;
        $this->entityManager = $entityManager;
        $this->topCityRepository = $topCityRepository;
    }

    public function updateTopCities(): void
    {
        $topCities = $this->topCityRepository->findBy(['lat' => null, 'lng' => null]);

        foreach ($topCities as $topCity) {
            try {
                $response = $this->coordinatesService->askGuGuTopCity($topCity);
                $coordinatesDTO = $this->coordinatesDTOBuilder->build($response);
            } catch (GuzzleException $e) {
                continue;
            }
            $topCity->setLat($coordinatesDTO->getLatitude());
            $topCity->setLng($coordinatesDTO->getLongitude());

            $this->entityManager->persist($topCity);
            $this->entityManager->flush();
        }
    }
}
