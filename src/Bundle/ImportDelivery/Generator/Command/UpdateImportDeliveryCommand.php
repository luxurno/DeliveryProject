<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Generator\Command;

use App\Bundle\ImportDelivery\DTO\ImportDeliveryDTO;
use App\Core\Coordinates\DTO\CoordinatesDTO;
use SimpleBus\Message\Name\NamedMessage;

class UpdateImportDeliveryCommand implements NamedMessage
{
    /** @var ImportDeliveryDTO */
    private $importDeliveryDTO;
    /** @var CoordinatesDTO */
    private $coordinatesDTO;

    public function __construct(
        ImportDeliveryDTO $importDeliveryDTO,
        CoordinatesDTO $coordinatesDTO
    )
    {
        $this->importDeliveryDTO = $importDeliveryDTO;
        $this->coordinatesDTO = $coordinatesDTO;
    }

    public function getImportDeliveryDTO(): ImportDeliveryDTO
    {
        return $this->importDeliveryDTO;
    }

    public function getCoordinatesDTO(): CoordinatesDTO
    {
        return $this->coordinatesDTO;
    }

    public static function messageName(): string
    {
        return 'App\Bundle\ImportDelivery\Generator\Command\UpdateImportDeliveryCommand';
    }
}
