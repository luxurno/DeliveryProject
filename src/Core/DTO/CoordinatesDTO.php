<?php

declare(strict_types = 1);

namespace App\Core\DTO;

class CoordinatesDTO
{
    /** @var string|null */
    private $latitude;
    /** @var string|null */
    private $longitude;

    public function getLatitude(): string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): void
    {
        $this->latitude = $latitude;
    }

    public function getLongitude(): string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): void
    {
        $this->longitude = $longitude;
    }
}
