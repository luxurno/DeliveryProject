<?php

declare(strict_types=1);

namespace App\Bundle\Perception\DTO;

use App\Core\Model\QueueMessage;

class PerceptionDTO implements QueueMessage
{
    /** @var string */
    private $country;
    /** @var string */
    private $voivodeship;
    /** @var int */
    private $userId;
    /** @var string */
    private $postalCode;
    /** @var string */
    private $city;
    /** @var string */
    private $street;
    /** @var string */
    private $number;
    /** @var float */
    private $capacity;
    /** @var int */
    private $weight;
    /** @var string */
    private $formatted;

    public function __construct(array $data)
    {
        $this->country = $data['country'];
        $this->voivodeship = $data['voivodeship'];
        $this->userId = (int) $data['userId'];
        $this->postalCode = $data['postal'];
        $this->city = $data['city'];
        $this->street = $data['street'];
        $this->number = $data['number'];
        $this->capacity = (float) $data['capacity'];
        $this->weight = (int) $data['weight'];
    }

    public static function create(array $data): PerceptionDTO
    {
        return new self($data);
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getVoivodeship(): string
    {
        return $this->voivodeship;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getCapacity(): float
    {
        return $this->capacity;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function getFormatted(): string
    {
        return $this->formatted;
    }

    public function setFormatted(string $formatted): void
    {
        $this->formatted = $formatted;
    }
}
