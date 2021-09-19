<?php

declare(strict_types=1);

namespace App\Bundle\Perception\Generator\Command;

use App\Bundle\Perception\DTO\PerceptionDTO;
use App\Core\Coordinates\DTO\CoordinatesDTO;
use SimpleBus\Message\Name\NamedMessage;

class UpdatePerceptionCommand implements NamedMessage
{
    /** @var PerceptionDTO */
    private $perceptionDTO;
    /** @var CoordinatesDTO */
    private $coordinatesDTO;

    public function __construct(
        PerceptionDTO $perceptionDTO,
        CoordinatesDTO $coordinatesDTO
    )
    {
        $this->perceptionDTO = $perceptionDTO;
        $this->coordinatesDTO = $coordinatesDTO;
    }

    public function getPerceptionDTO(): PerceptionDTO
    {
        return $this->perceptionDTO;
    }

    public function getCoordinatesDTO(): CoordinatesDTO
    {
        return $this->coordinatesDTO;
    }

    public static function messageName()
    {
        return 'App\Bundle\Perception\Generator\Command\UpdatePerceptionCommand';
    }
}