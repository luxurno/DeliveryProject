<?php

declare(strict_types = 1);

namespace App\Bundle\Generate\Analyzer;

use App\Bundle\Generate\DTO\GenerateDTO;

class LabelAnalyzer
{
    private const POSITIVE = 'pos';
    private const NEGATIVE = 'neg';

    public function analyze(GenerateDTO $driverHistory, array $warehousePackages): string
    {
        $driverHash = sha1($driverHistory->getCity().$driverHistory->getStreet());

        $exist = false;
        /** @var GenerateDTO $warehousePackage */
        foreach($warehousePackages as $warehousePackage) {
            $warehouseHash = sha1($warehousePackage->getCity().$warehousePackage->getStreet());

            if ($driverHash === $warehouseHash) {
                $exist = true;
            }
        }

        return $exist ? self::POSITIVE : self::NEGATIVE;
    }
}
