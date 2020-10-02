<?php

declare(strict_types = 1);

namespace App\Validator;

use App\ValueObject\DriverValueObject;

class DriverValidator
{
    private const ADR_OPTIONS = ['tak', 'nie'];

    public function validateAdr(DriverValueObject $driverValueObject): bool
    {
        return in_array($driverValueObject->getAdr(), self::ADR_OPTIONS);
    }
}
