<?php

declare(strict_types=1);

namespace App\Bundle\NearBy\Filter;

class NearByFilterArea
{
    private const AREA_LIMIT = 3;

    public function filter(array $nearBys, string $driverId): array
    {
        $areas = [];
        foreach ($nearBys as $nearBy) {
            if (count($areas) < self::AREA_LIMIT) {
                if ($driverId === $nearBy['driver_id']) {
                    $area = [
                        'lat' => $nearBy['lat'],
                        'lng' => $nearBy['lng'],
                    ];

                    $areas[] = $area;
                }
            }
        }

        return $areas;
    }
}
