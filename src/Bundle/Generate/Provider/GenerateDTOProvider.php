<?php

declare(strict_types = 1);

namespace App\Bundle\Generate\Provider;

use App\Bundle\Generate\DTO\GenerateDTO;

class GenerateDTOProvider
{
    public function provide(string $filePath): array
    {
        $rows = array_map('str_getcsv', file($filePath));
        $headers = array_shift($rows);
        $csv = [];
        foreach ($rows as $row) {
            $line = array_combine($headers, $row);
            $csv[] = GenerateDTO::create($line);
        }

        return $csv;
    }

}