<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Validator;

class ImportDeliveryValidator
{
    public function validate(array $headers, array $data): bool
    {
        return count($headers) === count($data);
    }
}
