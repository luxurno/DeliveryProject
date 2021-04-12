<?php

declare(strict_types=1);

namespace App\Core\Enum;

class PostalCodesEnum
{
    public const POSTAL_CODE_EMPTY = '00000';

    public static function getAll(): array
    {
        return [
            self::POSTAL_CODE_EMPTY,
        ];
    }
}
