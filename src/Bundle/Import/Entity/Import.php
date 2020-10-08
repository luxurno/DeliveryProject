<?php

declare(strict_types = 1);

namespace App\Bundle\Import\Entity;

use App\Bundle\ImportDelivery\Entity\ImportDelivery;
use App\Bundle\User\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
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
     * @ORM\Column(type="datetime")
     */
    private $createDate;
    /**
     * @ORM\Column(type="date")
     */
    private $importDate;
    /**
     * @ORM\OneToOne(targetEntity="App\Bundle\User\Entity\User", inversedBy="imports", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    /**
     * @ORM\OneToMany(targetEntity="App\Bundle\ImportDelivery\Entity\ImportDelivery", mappedBy="import", cascade={"persist"})
     * @ORM\JoinColumn(name="import_delivery_id", referencedColumnName="id")
     */
    protected $importDeliveries;
    /**
     * @ORM\Column(type="datetime")
     */
    private $changeDate;

    public function __construct()
    {
        $this->importDeliveries = new ArrayCollection();
    }

    public function addImportDeliveries(ImportDelivery $importDelivery): self
    {
        $this->importDeliveries->add($importDelivery);
        $importDelivery->setImport($this);

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getCreateDate()
    {
        return $this->createDate;
    }

    public function setCreateDate($createDate): void
    {
        $this->createDate = $createDate;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
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
