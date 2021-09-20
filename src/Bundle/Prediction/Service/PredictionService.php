<?php

declare(strict_types=1);

namespace App\Bundle\Prediction\Service;

class PredictionService
{
    private const FILENAME = __DIR__.'/../../../../ml/resources/';

    public function getPerceptionCity(string $voivodeship): string
    {
        $fileName = self::FILENAME.$voivodeship.'/prediction.csv';
        $file = fopen($fileName, 'r');

        $cities = [];
        while(! feof($file)) {
            $row = fgets($file);
            if (is_string($row)) {
                $city = explode(",", $row);
                $cities[$city[0]] = trim($city[1]);
            }
        }
        arsort($cities, SORT_NUMERIC);

        return array_keys($cities)[0];
    }
}
