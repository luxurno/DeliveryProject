<?php

declare(strict_types=1);

namespace App\Bundle\NearBy\Filter;

class NearByFilterDrivers
{
    private const DRIVER_LIMIT = 3;

    public function filter(array $nearBys): array
    {
        $drivers = [];
        foreach ($nearBys as $nearBy) {
            if (count($drivers) < self::DRIVER_LIMIT) {
                if (!in_array($nearBy['driver_id'], $drivers)) {
                    $drivers[] = $nearBy['driver_id'];
                }
            }
        }

        return $drivers;
    }
}
