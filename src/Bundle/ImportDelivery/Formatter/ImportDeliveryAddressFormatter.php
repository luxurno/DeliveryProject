<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Formatter;

use App\Bundle\ImportDelivery\DTO\ImportDeliveryDTO;

class ImportDeliveryAddressFormatter
{
    private const FORMAT = '%s %s, %s %s, %s, %s';

    public static function format(ImportDeliveryDTO $importDeliveryDTO): string
    {
        return sprintf(
            self::FORMAT,
            trim($importDeliveryDTO->getStreet()),
            trim($importDeliveryDTO->getNumber()),
            trim($importDeliveryDTO->getPostalCode()),
            trim($importDeliveryDTO->getCity()),
            trim($importDeliveryDTO->getVoivodeship()),
            trim($importDeliveryDTO->getCountry())
        );
    }
}
