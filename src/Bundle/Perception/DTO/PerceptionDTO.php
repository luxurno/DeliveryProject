<?php

declare(strict_types = 1);

namespace App\Bundle\Perception\DTO;

use App\Core\DTO\CoordinatesDTO;

class PerceptionDTO
{
    /** @var int */
    private $userId;
    /** @var string */
    private $postal;
    /** @var string */
    private $city;
    /** @var string */
    private $street;
    /** @var string */
    private $number;
    /** @var string */
    private $capacity;
    /** @var string */
    private $weight;
    /** @var CoordinatesDTO */
    private $coordinatesDTO;

    public function __construct()
    {
        $this->coordinatesDTO = new CoordinatesDTO();
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getPostal(): string
    {
        return $this->postal;
    }

    public function setPostal(string $postal): void
    {
        $this->postal = $postal;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function getCapacity(): string
    {
        return $this->capacity;
    }

    public function setCapacity(string $capacity): void
    {
        $this->capacity = $capacity;
    }

    public function getWeight(): string
    {
        return $this->weight;
    }

    public function setWeight(string $weight): void
    {
        $this->weight = $weight;
    }

    public function getCoordinatesDTO(): CoordinatesDTO
    {
        return $this->coordinatesDTO;
    }

    public function setCoordinatesDTO(CoordinatesDTO $coordinatesDTO): void
    {
        $this->coordinatesDTO = $coordinatesDTO;
    }
}
