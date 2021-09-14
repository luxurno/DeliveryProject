<?php

declare(strict_types=1);

namespace App\Tests\Unit\Bundle\ImportDelivery\Validator;

use App\Bundle\ImportDelivery\Validator\ImportDeliveryValidator;
use PHPUnit\Framework\TestCase;

class ImportDeliveryValidatorTest extends TestCase
{
    public function testValidate(): void
    {
        $headers = ['city', 'street', 'number'];
        $data = ['Sosnowiec', 'Wojska Polskiego', '43'];

        $importDeliveryValidator = new ImportDeliveryValidator();
        self::assertEquals(
            true,
            $importDeliveryValidator->validate($headers, $data)
        );
    }

    public function testValidateNegative(): void
    {
        $headers = ['city', 'street', 'number'];
        $data = ['Sosnowiec', 'Wojska Polskiego'];

        $importDeliveryValidator = new ImportDeliveryValidator();
        self::assertEquals(
            false,
            $importDeliveryValidator->validate($headers, $data)
        );
    }

}