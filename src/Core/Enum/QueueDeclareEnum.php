<?php

declare(strict_types = 1);

namespace App\Core\Enum;

class QueueDeclareEnum
{
    public const IMPORT_DELIVERY_COORDINATES_UPDATE = 'import_delivery_coordinates_update_%s';
    public const PERCEPTION_COORDINATES_UPDATE = 'perception_coordinates_update_%s';
}
