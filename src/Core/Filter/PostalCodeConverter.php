<?php

declare(strict_types=1);

namespace App\Core\Filter;

use App\Core\Enum\PostalCodesEnum;

class PostalCodeConverter
{
    public static function filter(string $text): ?string
    {
        $text = str_replace('-', '', $text);

        if (in_array($text, PostalCodesEnum::getAll(), true)) {
            return null;
        }

        return $text;
    }
}
