<?php

declare(strict_types=1);

namespace App\Bundle\Driver\Factory;

use App\Bundle\Driver\DTO\DriverDTO;

class DriverDTOFactory
{
    public function factory(): DriverDTO
    {
        return new DriverDTO();
    }
}
