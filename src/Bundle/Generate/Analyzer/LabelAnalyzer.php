<?php

declare(strict_types = 1);

namespace App\Bundle\Generate\Analyzer;

use App\Bundle\Generate\DTO\GenerateDTO;

class LabelAnalyzer
{
    public const POSITIVE = 'pos';
    public const NEGATIVE = 'neg';

    public function analyze(GenerateDTO $driverHistory, array $warehousePackages): string
    {
        $driverHash = sha1($driverHistory->getCity());

        /** @var GenerateDTO $warehousePackage */
        foreach($warehousePackages as $warehousePackage) {
            $warehouseHash = sha1($warehousePackage->getCity());

            if ($driverHash === $warehouseHash) {
                return self::POSITIVE;
            }
        }

        return self::NEGATIVE;
    }
}
