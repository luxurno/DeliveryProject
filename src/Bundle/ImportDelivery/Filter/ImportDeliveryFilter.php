<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Filter;

class ImportDeliveryFilter
{
    public function filterHeaders(array $importData): array
    {
        $headers = array_shift($importData['data'][0]);
        unset($importData['data'][0]);

        return $headers;
    }
}
