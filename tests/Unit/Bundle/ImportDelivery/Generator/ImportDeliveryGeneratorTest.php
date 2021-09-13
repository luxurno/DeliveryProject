<?php

declare(strict_types=1);

namespace App\Tests\Unit\Bundle\ImportDelivery\Generator;

use App\Bundle\Import\Entity\Import;
use App\Bundle\ImportDelivery\DTO\ImportDeliveryDTO;
use App\Bundle\ImportDelivery\Generator\ImportDeliveryGenerator;
use App\Core\Coordinates\DTO\CoordinatesDTO;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SimpleBus\SymfonyBridge\Bus\CommandBus;

class ImportDeliveryGeneratorTest extends TestCase
{
    /** @var CommandBus&MockObject */
    private $commandBus;
    /** @var Import&MockObject */
    private $import;
    /** @var ImportDeliveryDTO&MockObject */
    private $importDeliveryDTO;
    /** @var CoordinatesDTO&MockObject */
    private $coordinatesDTO;

    public function setUp(): void
    {
        $this->commandBus = $this->createMock(CommandBus::class);
        $this->import = $this->createMock(Import::class);
        $this->importDeliveryDTO = new ImportDeliveryDTO();
        $this->coordinatesDTO = new CoordinatesDTO();
    }

    public function testCreate(): void
    {
        $this->commandBus->expects(self::once())
            ->method('handle');

        $importDeliveryGenerator = new ImportDeliveryGenerator($this->commandBus);
        $importDeliveryGenerator->create($this->import, $this->importDeliveryDTO);
    }

    public function testUpdate(): void
    {
        $this->commandBus->expects(self::once())
            ->method('handle');

        $importDelivieryGenerator = new ImportDeliveryGenerator($this->commandBus);
        $importDelivieryGenerator->update($this->importDeliveryDTO, $this->coordinatesDTO);
    }
}
