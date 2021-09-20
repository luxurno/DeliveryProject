<?php

declare(strict_types=1);

namespace App\Bundle\Driver\DTO;

use JsonSerializable;

class DriverDTO implements JsonSerializable
{
    /** @var int */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $image;
    /** @var int */
    private $height;
    /** @var int */
    private $width;
    /** @var int */
    private $capacity;
    /** @var string */
    private $adr;
    /** @var array */
    private $area;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): void
    {
        $this->capacity = $capacity;
    }

    public function getAdr(): string
    {
        return $this->adr;
    }

    public function setAdr(string $adr): void
    {
        $this->adr = $adr;
    }

    public function getArea(): array
    {
        return $this->area;
    }

    public function setArea(array $area): void
    {
        $this->area = $area;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'height' => $this->height,
            'width' => $this->width,
            'capacity' => $this->capacity,
            'adr' => $this->adr,
            'area' => $this->area,
        ];
    }
}
