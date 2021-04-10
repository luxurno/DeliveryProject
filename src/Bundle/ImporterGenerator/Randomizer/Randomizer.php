<?php

declare(strict_types=1);

namespace App\Bundle\ImporterGenerator\Randomizer;

class Randomizer
{
    public static function random(array $ids, int $numberRange): int
    {
        $random = rand(1, $numberRange);

        if (in_array($random, $ids, true)) {
            self::random($ids, $numberRange);
        }

        return $random;
    }
}
