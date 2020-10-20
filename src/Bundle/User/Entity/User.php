<?php

declare(strict_types = 1);

namespace App\Bundle\User\Entity;

use App\Bundle\Import\Entity\Import;
use App\Entity\Driver;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Bundle\User\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Driver", mappedBy="driver", cascade={"persist"})
     */
    protected $drivers;
    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('spedytor', 'kierowca')")
     */
    private $type = 'spedytor';
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nick;
    /**
     * @ORM\Column(type="string", length=191, unique=true)
     */
    private $email;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;
    /**
     * @ORM\OneToMany(targetEntity="App\Bundle\Import\Entity\Import", mappedBy="user", cascade={"persist"})
     */
    protected $imports;
    /**
     * @var DateTime $updated
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updatedAt;
    /**
     * @var DateTime $created
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    public function __construct()
    {
        $this->drivers = new ArrayCollection();
        $this->imports = new ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps(): void
    {
        $this->setUpdatedAt(new DateTime('now'));
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new DateTime('now'));
        }
    }

    public function addImport(Import $import): self
    {
        $this->imports->add($import);
        $import->setUser($this);

        return $this;
    }

    public function addDriver(Driver $driver): self
    {
        $this->drivers->add($driver);
        $driver->setUser($this);

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getNick(): string
    {
        return $this->nick;
    }

    public function setNick(string $nick): void
    {
        $this->nick = $nick;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
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
