<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Entity;

use App\Bundle\Import\Entity\Import;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @ORM\Table(name="import_delivery",
 *     uniqueConstraints={
            @UniqueConstraint(name="import_delivery_unique",
 *              columns={"import_id", "formatted"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Bundle\ImportDelivery\Repository\ImportDeliveryRepository")
 */
class ImportDelivery
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
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $capacity;
    /**
     * @ORM\Column(type="integer")
     */
    private $weight;
    /**
     * @ORM\Column(type="string", length=511)
     */
    private $formatted;
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
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;
    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Bundle\Import\Entity\Import", inversedBy="importDeliveries", cascade={"persist"})
     * @ORM\JoinColumn(name="import_id", referencedColumnName="id")
     */
    protected $import;

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updateTimestamps(): void
    {
        $this->setUpdatedAt(new DateTime('now'));
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new DateTime('now'));
        }
    }

    public function getImport(): Import
    {
        return $this->import;
    }

    public function setImport(Import $import): void
    {
        $this->import = $import;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getVoivodeship()
    {
        return $this->voivodeship;
    }

    public function setVoivodeship($voivodeship): void
    {
        $this->voivodeship = $voivodeship;
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

    public function getCapacity(): float
    {
        return $this->capacity;
    }

    public function setCapacity(float $capacity): void
    {
        $this->capacity = $capacity;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    public function getFormatted(): string
    {
        return $this->formatted;
    }

    public function setFormatted(string $formatted): void
    {
        $this->formatted = $formatted;
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

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
