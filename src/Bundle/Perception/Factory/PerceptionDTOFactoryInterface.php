<?php

declare(strict_types = 1);

namespace App\Bundle\Perception\Factory;

use App\Bundle\Perception\DTO\PerceptionDTO;

interface PerceptionDTOFactoryInterface
{
    public function factory(): PerceptionDTO;
}
