<?php

declare(strict_types = 1);

namespace App\Bundle\Perception\Service;

use App\Bundle\Perception\Generator\PerceptionDTOGenerator;
use App\Bundle\User\Exception\UserNotFound;
use App\Bundle\User\Repository\UserRepository;
use App\Core\Coordinates\Service\CoordinatesService;

class PerceptionService
{
    /** @var CoordinatesService */
    private $coordinatesService;
    /** @var PerceptionDTOGenerator */
    private $perceptionDTOGenerator;
    /** @var UserRepository */
    private $userRepository;

    public function __construct(
        CoordinatesService $coordinatesService,
        PerceptionDTOGenerator $perceptionDTOGenerator,
        UserRepository $userRepository
    )
    {
        $this->coordinatesService = $coordinatesService;
        $this->perceptionDTOGenerator = $perceptionDTOGenerator;
        $this->userRepository = $userRepository;
    }

    public function savePerception(array $perceptionData): void
    {
        $perceptionDTO = $this->perceptionDTOGenerator->generate($perceptionData);

        $user = $this->userRepository->findOneBy(['id' => $perceptionDTO->getUserId()]);
        if ($user === null) {
            throw new UserNotFound(sprintf('User with id `%s` is missing', $perceptionDTO->getUserId()));
        }

        // TODO
        // Obsługa logiki trasy kierowcy, czy jeszcze jeźdźi
        // Logika pobrania lat/long
        // AI przypisania odpowiedniej kolejności
    }

}
