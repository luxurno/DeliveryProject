<?php

declare(strict_types = 1);

namespace App\Bundle\User\Entity;

use App\Bundle\Import\Entity\Import;
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
     * @ORM\OneToOne(targetEntity="App\Bundle\Import\Entity\Import", mappedBy="user", cascade={"persist"})
     */
    protected $import;
    /**
     * @var DateTime $created
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;
    /**
     * @var DateTime $updated
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected $updatedAt;

    public function __construct()
    {
        $this->import = new ArrayCollection();
    }

    public function addImport(Import $import): self
    {
        $this->import->add($import);
        $import->setUser($this);

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

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
