<?php

declare(strict_types = 1);

namespace App\Bundle\Driver\ValueObject;

class DriverValueObject
{
    /** @var null|int */
    private $id;
    /** @var null|int */
    private $userId;
    /** @var null|string */
    private $name;
    /** @var null|int */
    private $height;
    /** @var null|int */
    private $length;
    /** @var null|int */
    private $width;
    /** @var null|int */
    private $capacity;
    /** @var null|string */
    private $adr;

    public function __construct(
        ?int $id = null,
        ?int $userId = null,
        ?string $name = null,
        ?int $height = null,
        ?int $length = null,
        ?int $width = null,
        ?int $capacity = null,
        ?string $adr = null
    )
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->name = $name;
        $this->height = $height;
        $this->length = $length;
        $this->width = $width;
        $this->capacity = $capacity;
        $this->adr = $adr;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function getLength(): ?int
    {
        return $this->length;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function getAdr(): ?string
    {
        return $this->adr;
    }
}
