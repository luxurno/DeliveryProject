<?php

declare(strict_types=1);

namespace App\Bundle\Perception\Generator;

use App\Bundle\Perception\DTO\PerceptionDTO;
use App\Bundle\Perception\Generator\Command\UpdatePerceptionCommand;
use App\Core\Coordinates\DTO\CoordinatesDTO;
use SimpleBus\SymfonyBridge\Bus\CommandBus;

class PerceptionGenerator
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

    public function update(PerceptionDTO $perceptionDTO, CoordinatesDTO $coordinatesDTO): void
    {
        $this->commandBus->handle(new UpdatePerceptionCommand($perceptionDTO, $coordinatesDTO));
    }
}
