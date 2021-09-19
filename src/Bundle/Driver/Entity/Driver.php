<?php

declare(strict_types = 1);

namespace App\Bundle\Driver\Entity;

use App\Bundle\Route\Entity\Route;
use App\Bundle\User\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DriverRepository")
 */
class Driver implements JsonSerializable
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
    private $name;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $height;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $length;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $width;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $capacity;
    /**
     * @ORM\Column(type="string", options={"default" : "nie"})
     */
    private $adr;
    /**
     * @ORM\Column(name="available", type="integer", columnDefinition="ENUM('0', '1', '2')")
     */
    private $available;

    /**
     * @ORM\ManyToOne(targetEntity="App\Bundle\User\Entity\User", inversedBy="drivers", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): void
    {
        $this->image = $image;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height): void
    {
        $this->height = $height;
    }

    public function getLength(): ?int
    {
        return $this->length;
    }

    public function setLength(?int $length): void
    {
        $this->length = $length;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($width): void
    {
        $this->width = $width;
    }

    public function getCapacity()
    {
        return $this->capacity;
    }

    public function setCapacity($capacity): void
    {
        $this->capacity = $capacity;
    }

    public function getAdr()
    {
        return $this->adr;
    }

    public function setAdr($adr): void
    {
        $this->adr = $adr;
    }

    public function setAvailable(Int $available): void
    {
        $this->available = $available;
    }

    public function getAvailable(): int
    {
        return $this->available;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'image' => $this->getImage(),
        ];
    }
}
