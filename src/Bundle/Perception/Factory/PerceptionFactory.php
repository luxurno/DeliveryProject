<?php

declare(strict_types=1);

namespace App\Bundle\Perception\Factory;

use App\Bundle\Perception\Entity\Perception;

class PerceptionFactory
{
    public function factory(): Perception
    {
        return new Perception();
    }
}
