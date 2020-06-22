<?php

declare(strict_types = 1);

namespace App\ValueObject;

class DriverValueObject
{
    /** @var int */
    private $id;
    /** @var int */
    private $height;
    /** @var int */
    private $width;
    /** @var int */
    private $capacity;
    /** @var string */
    private $adr;

    public function __construct(int $id, int $height, int $width, int $capacity, string $adr)
    {
        $this->id = $id;
        $this->height = $height;
        $this->width = $width;
        $this->capacity = $capacity;
        $this->adr = $adr;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function getAdr(): string
    {
        return $this->adr;
    }
}
