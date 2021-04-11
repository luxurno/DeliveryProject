<?php

declare(strict_types=1);

namespace App\Core\Filter;

class PostalCodeConverter
{
    public static function filter(string $text): string
    {
        return str_replace('-', '', $text);
    }
}
