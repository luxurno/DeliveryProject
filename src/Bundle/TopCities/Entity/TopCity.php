<?php

declare(strict_types=1);

namespace App\Bundle\TopCities\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Bundle\TopCities\Repository\TopCityRepository")
 */
class TopCity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
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
    private $city;
    /**
     * @var string
     *
     * @ORM\Column(name="lat", type="decimal", precision=20, scale=16, options={"default" : null}, nullable=true)
     */
    private $lat;
    /**
     * @var string
     *
     * @ORM\Column(name="lng", type="decimal", precision=20, scale=16, options={"default" : null}, nullable=true)
     */
    private $lng;
    /**
     * @var DateTime $created
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $dateTime = new DateTime('now');
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt($dateTime);
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

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

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getLat(): string
    {
        return $this->lat;
    }

    public function setLat(string $lat): void
    {
        $this->lat = $lat;
    }

    public function getLng(): string
    {
        return $this->lng;
    }

    public function setLng(string $lng): void
    {
        $this->lng = $lng;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
