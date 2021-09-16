<?php

declare(strict_types = 1);

namespace App\Bundle\Generate\Parser;

use App\Bundle\Generate\DTO\GenerateDTO;

class GenerateDTOParser
{
    public static function parse(GenerateDTO $generateDTO): string
    {
        return implode(' ', [
            $generateDTO->getCountry(),
            $generateDTO->getVoivodeship(),
            $generateDTO->getDistrict(),
            $generateDTO->getCommunity(),
            $generateDTO->getCity(),
            $generateDTO->getPostalCode(),
            $generateDTO->getStreet(),
            $generateDTO->getNumber(),
        ]);
    }

}