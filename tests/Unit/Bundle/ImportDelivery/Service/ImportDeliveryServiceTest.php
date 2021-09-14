<?php

declare(strict_types=1);

namespace App\Tests\Unit\Bundle\ImportDelivery\Service;

use App\Bundle\Import\Entity\Import;
use App\Bundle\Import\Factory\ImportFactory;
use App\Bundle\ImportDelivery\DTO\ImportDeliveryDTO;
use App\Bundle\ImportDelivery\Factory\ImportDeliveryDTOFactory;
use App\Bundle\ImportDelivery\Generator\ImportDeliveryGenerator;
use App\Bundle\ImportDelivery\Producer\ImportDeliveryProducer;
use App\Bundle\ImportDelivery\Service\ImportDeliveryService;
use App\Bundle\ImporterGenerator\Enum\ImportFileHeadersEnum;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ImportDeliveryServiceTest extends TestCase
{
    private const COUNTRY = 'Polska';
    private const DISTRICT = 'raciborski';
    private const COMMUNITY = 'Kuźnia Raciborska';
    private const CITY = 'Rudy';
    private const STREET = 'Rybnicka';
    private const NUMBER = '20';
    private const POSTAL_CODE = '47-430';

    /** @var ImportDeliveryDTOFactory&MockObject */
    private $importDeliveryDTOFactory;
    /** @var ImportDeliveryGenerator&MockObject */
    private $importDeliveryGenerator;
    /** @var ImportDeliveryProducer&MockObject */
    private $importDeliveryProducer;
    /** @var ImportFactory&MockObject */
    private $importFactory;

    protected function setUp(): void
    {
        $this->importDeliveryDTOFactory = $this->createMock(ImportDeliveryDTOFactory::class);
        $this->importDeliveryGenerator = $this->createMock(ImportDeliveryGenerator::class);
        $this->importDeliveryProducer = $this->createMock(ImportDeliveryProducer::class);
        $this->importFactory = $this->createMock(ImportFactory::class);
    }

    public function testCreateImportDelivery(): void
    {
        $importDeliveryDTO = $this->createMock(ImportDeliveryDTO::class);

        $importDelivery = [
            ImportFileHeadersEnum::COUNTRY => self::COUNTRY,
            ImportFileHeadersEnum::DISTRICT => self::DISTRICT,
            ImportFileHeadersEnum::COMMUNITY => self::COMMUNITY,
            ImportFileHeadersEnum::CITY => self::CITY,
            ImportFileHeadersEnum::STREET => self::STREET,
            ImportFileHeadersEnum::NUMBER => self::NUMBER,
            ImportFileHeadersEnum::POSTAL_CODE => self::POSTAL_CODE,
        ];

        $this->importDeliveryDTOFactory->expects(self::once())
            ->method('factory')
            ->willReturn($importDeliveryDTO);

        $this->importDeliveryGenerator->expects(self::once())
            ->method('create');
        $this->importDeliveryProducer->expects(self::once())
            ->method('addQueue');

        $importDeliveryService = new ImportDeliveryService(
            $this->importDeliveryDTOFactory,
            $this->importDeliveryGenerator,
            $this->importDeliveryProducer,
            $this->importFactory
        );
        $importDeliveryService->createImportDelivery(
            $this->createMock(Import::class),
            $importDelivery,
            0
        );
    }
}
