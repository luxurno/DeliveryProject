<?php

declare(strict_types=1);

namespace App\Bundle\Route\Validator;

use App\Bundle\Route\Capacity\DriverCapacity;

class RouteValidator
{
    public static function validate(
        float $packageCapacity,
        int $packageWeight
    ): bool
    {
        return DriverCapacity::getDriverCapacity() >= $packageCapacity &&
            DriverCapacity::getDriverWeight() >= $packageWeight;
    }
}
