<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Factory;

use App\Bundle\ImportDelivery\DTO\ImportDeliveryDTO;

class ImportDeliveryDTOFactory implements ImportDeliveryDTOFactoryInterface
{
    public function factory(): ImportDeliveryDTO
    {
        return new ImportDeliveryDTO();
    }
}
