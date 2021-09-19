<?php

declare(strict_types=1);

namespace App\Bundle\Route\Capacity;

class DriverCapacity
{
    /** @var float */
    private static $driverCapacity;
    /** @var int */
    private static $driverWeight;

    public static function setDriverCapacity(float $driverCapacity): void
    {
        self::$driverCapacity = $driverCapacity;
    }

    public static function getDriverCapacity(): float
    {
        return self::$driverCapacity;
    }

    public static function setDriverWeight(int $driverWeight): void
    {
        self::$driverWeight = $driverWeight;
    }

    public static function getDriverWeight(): int
    {
        return self::$driverWeight;
    }
}
