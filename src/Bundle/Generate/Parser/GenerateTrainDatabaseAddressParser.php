<?php

declare(strict_types = 1);

namespace App\Bundle\Generate\Parser;

use App\Bundle\ImporterGenerator\Entity\TotalAddress;

class GenerateTrainDatabaseAddressParser
{
    public static function getAddress(TotalAddress $totalAddress): string
    {
        return implode(' ', [
            $totalAddress->getCountry(),
            $totalAddress->getVoivodeship(),
            $totalAddress->getDistrict(),
            $totalAddress->getCommunity(),
            $totalAddress->getCity(),
            $totalAddress->getPostalCode(),
            $totalAddress->getStreet(),
            $totalAddress->getNumber(),
        ]);
    }
}