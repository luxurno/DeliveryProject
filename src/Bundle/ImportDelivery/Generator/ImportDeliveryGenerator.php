<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Generator;

use App\Bundle\Import\Entity\Import;
use App\Bundle\ImportDelivery\DTO\ImportDeliveryDTO;
use App\Bundle\ImportDelivery\Generator\Command\CreateImportDeliveryCommand;
use App\Bundle\ImportDelivery\Generator\Command\UpdateImportDeliveryCommand;
use App\Core\Coordinates\DTO\CoordinatesDTO;
use SimpleBus\SymfonyBridge\Bus\CommandBus;

class ImportDeliveryGenerator
{
    /** @var CommandBus */
    private $commandBus;

    /**
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function create(Import $import, ImportDeliveryDTO $importDeliveryDTO): void
    {
        $this->commandBus->handle(new CreateImportDeliveryCommand($import, $importDeliveryDTO));
    }

    public function update(ImportDeliveryDTO $importDeliveryDTO, CoordinatesDTO $coordinatesDTO): void
    {
        $this->commandBus->handle(new UpdateImportDeliveryCommand($importDeliveryDTO, $coordinatesDTO));
    }
}
