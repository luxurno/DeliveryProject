<?php

declare(strict_types=1);

namespace App\Bundle\Route\Factory;

use App\Bundle\Route\Entity\Route;

class RouteFactory
{
    public function factory(): Route
    {
        return new Route();
    }
}
