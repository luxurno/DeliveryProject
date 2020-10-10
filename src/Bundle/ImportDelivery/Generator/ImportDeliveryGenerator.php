<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Generator;

use App\Bundle\Import\Entity\Import;
use App\Bundle\ImportDelivery\DTO\ImportDeliveryDTO;
use App\Bundle\ImportDelivery\Generator\Command\CreateImportDeliveryCommand;
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

    public function generate(Import $import, ImportDeliveryDTO $importDeliveryDTO)
    {
        $this->commandBus->handle(new CreateImportDeliveryCommand($import, $importDeliveryDTO));
    }
}