<?php

declare(strict_types = 1);

namespace App\Bundle\Perception\Factory;

use App\Bundle\Perception\DTO\PerceptionDTO;

class PerceptionDTOFactory implements PerceptionDTOFactoryInterface
{
    public function factory(): PerceptionDTO
    {
        return new PerceptionDTO();
    }
}
