<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Factory;

use App\Bundle\ImportDelivery\DTO\ImportDeliveryDTO;

interface ImportDeliveryDTOFactoryInterface
{
    public function factory(): ImportDeliveryDTO;
}
