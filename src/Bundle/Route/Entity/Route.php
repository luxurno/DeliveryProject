<?php

declare(strict_types = 1);

namespace App\Bundle\Route\Entity;

use App\Bundle\Driver\Entity\Driver;
use App\Bundle\Import\Entity\Import;
use App\Bundle\ImportDelivery\Entity\ImportDelivery;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @ORM\Table(name="route")
 * @ORM\Entity(repositoryClass="App\Bundle\Route\Repository\RouteRepository")
 */
class Route
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\OneToOne(targetEntity="App\Bundle\ImportDelivery\Entity\ImportDelivery", mappedBy="route", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="import_delivery_id", referencedColumnName="id")
     */
    protected $importDelivery;
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
        $this->imports = new ArrayCollection();
        $this->drivers = new ArrayCollection();
    }

    public function setImportDelivery(ImportDelivery $importDelivery): void
    {
        $this->importDelivery = $importDelivery;
        $importDelivery->setRoute($this);
    }

    public function getImportDelivery(): ImportDelivery
    {
        return $this->importDelivery;
    }

    public function setImports(Import $import): void
    {
        $this->imports->add($import);
        $import->setRoute($this);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getCreatedAt() :?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
