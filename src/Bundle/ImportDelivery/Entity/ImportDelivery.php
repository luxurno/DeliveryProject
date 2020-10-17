<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Entity;

use App\Bundle\Import\Entity\Import;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
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
    private $kraj;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $voivodeship;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $powiat;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gmina;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $miasto;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ulica;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numer;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $kodPocztowy;
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

    public function getKraj()
    {
        return $this->kraj;
    }

    public function setKraj($kraj): void
    {
        $this->kraj = $kraj;
    }

    public function getPowiat()
    {
        return $this->powiat;
    }

    public function setPowiat($powiat): void
    {
        $this->powiat = $powiat;
    }

    public function getGmina()
    {
        return $this->gmina;
    }

    public function setGmina($gmina): void
    {
        $this->gmina = $gmina;
    }

    public function getMiasto()
    {
        return $this->miasto;
    }

    public function setMiasto($miasto): void
    {
        $this->miasto = $miasto;
    }

    public function getUlica()
    {
        return $this->ulica;
    }

    public function setUlica($ulica): void
    {
        $this->ulica = $ulica;
    }

    public function getNumer()
    {
        return $this->numer;
    }

    public function setNumer($numer): void
    {
        $this->numer = $numer;
    }

    public function getKodPocztowy()
    {
        return $this->kodPocztowy;
    }

    public function setKodPocztowy($kodPocztowy): void
    {
        $this->kodPocztowy = $kodPocztowy;
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