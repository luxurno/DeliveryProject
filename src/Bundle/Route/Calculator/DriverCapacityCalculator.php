<?php

declare(strict_types=1);

namespace App\Bundle\Route\Calculator;

use App\Bundle\Driver\Entity\Driver;

class DriverCapacityCalculator
{
    public function calculate(Driver $driver): float
    {
        return round($driver->getLength() * $driver->getHeight() * $driver->getWidth(), 2)/ 1000000;
    }
}
