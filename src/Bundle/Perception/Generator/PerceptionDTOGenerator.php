<?php

declare(strict_types = 1);

namespace App\Bundle\Perception\Generator;

use App\Bundle\Perception\DTO\PerceptionDTO;
use App\Bundle\Perception\Factory\PerceptionDTOFactory;

class PerceptionDTOGenerator
{
    /** @var PerceptionDTOFactory */
    private $perceptionDTOFactory;

    public function __construct(PerceptionDTOFactory $perceptionDTOFactory)
    {
        $this->perceptionDTOFactory = $perceptionDTOFactory;
    }

    public function generate(array $perceptionData): PerceptionDTO
    {
        $perceptionDTO = $this->perceptionDTOFactory->factory();

        $perceptionDTO->setUserId((int) $perceptionData['userId'] ?? '');
        $perceptionDTO->setPostal($perceptionData['postal'] ?? '');
        $perceptionDTO->setCity($perceptionData['city'] ?? '');
        $perceptionDTO->setStreet($perceptionData['street'] ?? '');
        $perceptionDTO->setNumber($perceptionData['number'] ?? '');
        $perceptionDTO->setCapacity($perceptionData['capacity'] ?? '');
        $perceptionDTO->setWeight($perceptionData['weight'] ?? '');

        return $perceptionDTO;
    }
}
