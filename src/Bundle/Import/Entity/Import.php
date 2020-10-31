<?php

declare(strict_types = 1);

namespace App\Bundle\Import\Entity;

use App\Bundle\ImportDelivery\Entity\ImportDelivery;
use App\Bundle\User\Entity\User;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @ORM\Table(name="import",
 *     uniqueConstraints={
            @UniqueConstraint(name="import_unique",
 *              columns={"import_date", "user_id"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Bundle\Import\Repository\ImportRepository")
 */
class Import
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(name="import_date", type="date")
     */
    private $importDate;
    /**
     * @ORM\OneToOne(targetEntity="App\Bundle\User\Entity\User", inversedBy="imports", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    /**
     * @ORM\OneToMany(targetEntity="App\Bundle\ImportDelivery\Entity\ImportDelivery", mappedBy="import", cascade={"persist", "remove"})
     */
    protected $importDeliveries;
    /**
     * @var DateTime $created
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $dateTimeNow = new DateTime('now');
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt($dateTimeNow);
        }
        $dateTimeNow->format('Y-m-d');
        $this->setImportDate($dateTimeNow);
        $this->importDeliveries = new ArrayCollection();
    }

    public function setImportDeliveries(ImportDelivery $importDelivery): void
    {
        $this->importDeliveries->add($importDelivery);
        $importDelivery->setImport($this);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getImportDate(): DateTime
    {
        return $this->importDate;
    }

    public function setImportDate(DateTime $importDate): void
    {
        $this->importDate = $importDate;
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
