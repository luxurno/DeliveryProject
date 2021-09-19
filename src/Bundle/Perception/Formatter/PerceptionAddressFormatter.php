<?php

declare(strict_types=1);

namespace App\Bundle\Perception\Formatter;

use App\Bundle\Perception\DTO\PerceptionDTO;

class PerceptionAddressFormatter
{
    private const FORMAT = '%s %s, %s %s, %s, %s';

    public static function format(PerceptionDTO $perceptionDTO): string
    {
        return sprintf(
            self::FORMAT,
            trim($perceptionDTO->getStreet()),
            trim($perceptionDTO->getNumber()),
            trim($perceptionDTO->getPostalCode()),
            trim($perceptionDTO->getCity()),
            trim($perceptionDTO->getVoivodeship()),
            trim($perceptionDTO->getCountry())
        );
    }
}