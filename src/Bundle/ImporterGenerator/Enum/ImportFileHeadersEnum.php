<?php

declare(strict_types = 1);

namespace App\Bundle\ImporterGenerator\Enum;

class ImportFileHeadersEnum
{
    public const ID = 'id';
    public const COUNTRY = 'kraj';
    public const DISTRICT = 'powiat';
    public const COMMUNITY = 'gmina';
    public const CITY = 'miasto';
    public const STREET = 'ulica';
    public const NUMBER = 'numer';
    public const POSTAL_CODE = 'kod_pocztowy';
    public const HASH = 'hash';

    public static function getAllHeaders(): array
    {
        return [
            self::COUNTRY,
            self::DISTRICT,
            self::COMMUNITY,
            self::CITY,
            self::STREET,
            self::NUMBER,
            self::POSTAL_CODE,
        ];
    }
}