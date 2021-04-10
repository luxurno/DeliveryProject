<?php

declare(strict_types = 1);

namespace App\Bundle\ImporterGenerator\Generator;

use App\Bundle\ImporterGenerator\Provider\TotalAddressCountProvider;
use App\Bundle\ImporterGenerator\Randomizer\Randomizer;
use App\Bundle\ImporterGenerator\Repository\TotalAddressRepository;

class RandomIdsTotalAddressGenerator
{
    /** @var TotalAddressCountProvider */
    private $totalAddressCountProvider;

    public function __construct(TotalAddressCountProvider $totalAddressCountProvider)
    {
        $this->totalAddressCountProvider = $totalAddressCountProvider;
    }

    public function generateIds(int $numbersCount): array
    {
        $numberRange = $this->totalAddressCountProvider->provideCountByVoivodeship();

        $numbers = [];
        for ($i=1; $i<= $numbersCount; $i++) {
            $numbers[] = Randomizer::random($numbers, $numberRange);
        }

        return $numbers;
    }
}
