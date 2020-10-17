<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Factory;

use App\Bundle\ImportDelivery\Entity\ImportDelivery;

class ImportDeliveryFactory implements ImportDeliveryFactoryInterface
{
    public function factory(): ImportDelivery
    {
        return new ImportDelivery();
    }
}
