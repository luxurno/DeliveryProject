<?php

declare(strict_types=1);

namespace App\Tests\Unit\Bundle\ImportDelivery\Formatter;

use App\Bundle\ImportDelivery\DTO\ImportDeliveryDTO;
use App\Bundle\ImportDelivery\Formatter\ImportDeliveryAddressFormatter;
use PHPUnit\Framework\TestCase;

class ImportDeliveryAddressFormatterTest extends TestCase
{
    public function testFormat(): void
    {
        $importDeliveryDTO = new ImportDeliveryDTO();

        $importDeliveryDTO->setCountry('Polska');
        $importDeliveryDTO->setVoivodeship('Śląsk');
        $importDeliveryDTO->setDistrict('raciborski');
        $importDeliveryDTO->setCommunity('Kuźnia Raciborska');
        $importDeliveryDTO->setCity('Rudy');
        $importDeliveryDTO->setStreet('Rybnicka');
        $importDeliveryDTO->setNumber('6');
        $importDeliveryDTO->setPostalCode('47-430');

        self::assertEquals(
            'Rybnicka 6, 47-430 Rudy, Śląsk, Polska',
            ImportDeliveryAddressFormatter::format($importDeliveryDTO)
        );
    }
}
