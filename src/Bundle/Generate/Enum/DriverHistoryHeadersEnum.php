<?php

declare(strict_types = 1);

namespace App\Bundle\Generate\Enum;

class DriverHistoryHeadersEnum
{
    public const INDEX = 'index';
    public const TYPE = 'type';
    public const LABEL = 'label';
    public const FILE = 'file';
    public const REVIEW = 'review';

    public static function getAll(): array
    {
        return [
            self::INDEX,
            self::TYPE,
            self::LABEL,
            self::FILE,
            self::REVIEW,
        ];
    }
}