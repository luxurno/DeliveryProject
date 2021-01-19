<?php

declare(strict_types = 1);

namespace App\Bundle\Generate\DTO;

use App\Bundle\ImporterGenerator\Enum\ImportFileHeadersEnum;

class GenerateDTO
{
    /** @var int */
    private $id;
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
    /** @var string */
    private $hash;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->country = $data[ImportFileHeadersEnum::COUNTRY];
        $this->voivodeship = '';
        $this->district = $data[ImportFileHeadersEnum::DISTRICT];
        $this->community = $data[ImportFileHeadersEnum::COMMUNITY];
        $this->city = $data[ImportFileHeadersEnum::CITY];
        $this->street = $data[ImportFileHeadersEnum::STREET];
        $this->number = $data[ImportFileHeadersEnum::NUMBER];
        $this->postalCode = $data[ImportFileHeadersEnum::POSTAL_CODE];
        $this->hash = $data['hash'];
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getVoivodeship(): string
    {
        return $this->voivodeship;
    }

    public function getDistrict(): string
    {
        return $this->district;
    }

    public function getCommunity(): string
    {
        return $this->community;
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

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public static function create(array $data): self
    {
        return new self($data);
    }
}