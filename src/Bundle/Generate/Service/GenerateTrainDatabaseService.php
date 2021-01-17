<?php

declare(strict_types = 1);

namespace App\Bundle\Generate\Service;

use App\Bundle\Generate\Exception\MissingDatabaseImport;
use App\Bundle\ImporterGenerator\Provider\TotalAddressCountProvider;

class GenerateTrainDatabaseService
{
    private const LOCATION = __DIR__ . '/../../../../resources/';
    /** @var TotalAddressCountProvider */
    private $totalAddressCountProvider;

    public function __construct(TotalAddressCountProvider $totalAddressCountProvider)
    {
        $this->totalAddressCountProvider = $totalAddressCountProvider;
    }

    public function generateCsv(string $fileName): void
    {
        $numberRange = $this->totalAddressCountProvider->provideCountByVoivodeship();

        if ($numberRange <= 1) {
            throw new MissingDatabaseImport('You need to import DB first');
        }

    }
}