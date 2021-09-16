<?php

declare(strict_types = 1);

namespace App\Bundle\ImporterGenerator\Enum;

class ImportFileHeadersEnum
{
    public const ID = 'id';
    public const COUNTRY = 'country';
    public const VOIVODESHIP = 'voivodeship';
    public const DISTRICT = 'district';
    public const COMMUNITY = 'community';
    public const CITY = 'city';
    public const STREET = 'street';
    public const NUMBER = 'number';
    public const POSTAL_CODE = 'postal_code';
    public const CAPACITY = 'capacity';
    public const WEIGHT = 'weight';
    public const HASH = 'hash';

    public static function getAllHeaders(): array
    {
        return [
            self::COUNTRY,
            self::VOIVODESHIP,
            self::DISTRICT,
            self::COMMUNITY,
            self::CITY,
            self::STREET,
            self::NUMBER,
            self::POSTAL_CODE,
            self::CAPACITY,
            self::WEIGHT,
        ];
    }
}