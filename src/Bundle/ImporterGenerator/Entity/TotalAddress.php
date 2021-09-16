<?php

declare(strict_types = 1);

namespace App\Bundle\ImporterGenerator\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Bundle\ImporterGenerator\Repository\TotalAddressRepository")
 */
class TotalAddress
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="datetime")
     */
    private $createDate;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $voivodeship;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $district;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $community;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $street;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $number;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $postalCode;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hash;
    /**
     * @ORM\Column(type="datetime", options={"default" : null}, nullable=true)
     */
    private $changeDate = null;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getVoivodeship(): string
    {
        return $this->voivodeship;
    }

    public function setVoivodeship(string $voivodeship): void
    {
        $this->voivodeship = $voivodeship;
    }

    public function getCreateDate()
    {
        return $this->createDate;
    }

    public function setCreateDate($createDate): void
    {
        $this->createDate = $createDate;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
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

    public function getHash(): string
    {
        return $this->hash;
    }

    public function setHash(string $hash): void
    {
        $this->hash = $hash;
    }

    public function getChangeDate()
    {
        return $this->changeDate;
    }

    public function setChangeDate($changeDate): void
    {
        $this->changeDate = $changeDate;
    }
}
