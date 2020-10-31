<?php

declare(strict_types = 1);

namespace App\Core\Coordinates\Provider;

use App\Core\Coordinates\Builder\CoordinatesDTOBuilder;
use App\Core\Coordinates\DTO\CoordinatesDTO;
use App\Core\Model\QueueMessage;
use App\Core\Coordinates\Service\CoordinatesService;
use GuzzleHttp\Exception\GuzzleException;

class CoordinatesProvider
{
    /** @var CoordinatesDTOBuilder */
    private $coordinatesDTOBuilder;
    /** @var CoordinatesService */
    private $coordinatesService;

    public function __construct(
        CoordinatesDTOBuilder $coordinatesDTOBuilder,
        CoordinatesService $coordinatesService
    )
    {
        $this->coordinatesDTOBuilder = $coordinatesDTOBuilder;
        $this->coordinatesService = $coordinatesService;
    }

    public function provide(QueueMessage $queueMessage): ?CoordinatesDTO
    {
        try {
            $response = $this->coordinatesService->askGuGu($queueMessage);
            return $this->coordinatesDTOBuilder->build($response);
        } catch (GuzzleException $e) {
            return null;
        }
    }
}
