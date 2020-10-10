<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Generator\Command;

use App\Bundle\Import\Entity\Import;
use App\Bundle\ImportDelivery\DTO\ImportDeliveryDTO;
use SimpleBus\Message\Name\NamedMessage;

class CreateImportDeliveryCommand implements NamedMessage
{
    /** @var Import */
    private $import;
    /** @var ImportDeliveryDTO */
    private $importDeliveryDTO;

    public function __construct(
        Import $import,
        ImportDeliveryDTO $importDeliveryDTO
    )
    {
        $this->import = $import;
        $this->importDeliveryDTO = $importDeliveryDTO;
    }

    public function getImport(): Import
    {
        return $this->import;
    }

    public function getImportDeliveryDTO(): ImportDeliveryDTO
    {
        return $this->importDeliveryDTO;
    }

    public static function messageName(): string
    {
        return 'App\Bundle\ImportDelivery\Generator\Command\CreateImportDeliveryCommand';
    }
}