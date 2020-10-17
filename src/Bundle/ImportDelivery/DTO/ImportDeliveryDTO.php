<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\DTO;

class ImportDeliveryDTO
{
    /** @var string */
    private $country;
    /** @var string */
    private $voivodeship;
    /** @var string */
    private $district;
    /** @var string */
    private $community;
    /** @var string */
    private $city;
    /** @var string */
    private $street;
    /** @var string */
    private $number;
    /** @var string */
    private $postalCode;

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getVoivodeship(): string
    {
        return $this->voivodeship;
    }

    public function setVoivodeship(string $voivodeship): void
    {
        $this->voivodeship = $voivodeship;
    }

    public function getDistrict(): string
    {
        return $this->district;
    }

    public function setDistrict(string $district): void
    {
        $this->district = $district;
    }

    public function getCommunity(): string
    {
        return $this->community;
    }

    public function setCommunity(string $community): void
    {
        $this->community = $community;
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

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }
}
