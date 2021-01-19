<?php

declare(strict_types = 1);

namespace App\Bundle\Generate\Parser;

use App\Bundle\ImporterGenerator\Entity\TotalAddress;

class GenerateTrainDatabaseAddressParser
{
    public static function getAddress(TotalAddress $totalAddress): string
    {
        return implode(' ', [
            $totalAddress->getKraj(),
            $totalAddress->getVoivodeship(),
            $totalAddress->getPowiat(),
            $totalAddress->getGmina(),
            $totalAddress->getMiasto(),
            $totalAddress->getKodPocztowy(),
            $totalAddress->getUlica(),
            $totalAddress->getNumer(),
        ]);
    }
}