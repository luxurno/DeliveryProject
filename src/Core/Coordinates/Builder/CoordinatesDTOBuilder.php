<?php

declare(strict_types = 1);

namespace App\Core\Coordinates\Builder;

use App\Core\Coordinates\DTO\CoordinatesDTO;

class CoordinatesDTOBuilder
{
    public function build(string $response): ?CoordinatesDTO
    {
        $coordinatesDTO = new CoordinatesDTO();
        $response = json_decode($response, true);

        $coordinatesDTO->setLatitude((string) $response['results'][0]['geometry']['location']['lat'] ?? null);
        $coordinatesDTO->setLongitude((string) $response['results'][0]['geometry']['location']['lng'] ?? null);

        return $coordinatesDTO;
    }
}
