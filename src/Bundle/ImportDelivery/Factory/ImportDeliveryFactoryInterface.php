<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Factory;

use App\Bundle\ImportDelivery\Entity\ImportDelivery;

interface ImportDeliveryFactoryInterface
{
    public function factory(): ImportDelivery;
}
