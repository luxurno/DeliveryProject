<?php

declare(strict_types = 1);

namespace App\Bundle\Driver\Validator;

use App\Bundle\User\Repository\UserRepository;
use App\Bundle\Driver\Enum\AdrEnum;
use App\Bundle\Driver\ValueObject\DriverValueObject;

class DriverValidator
{
    private const ADR_OPTIONS = [
        AdrEnum::YES,
        AdrEnum::NO,
    ];

    /** @var UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function validateAdr(DriverValueObject $driverValueObject): bool
    {
        return in_array($driverValueObject->getAdr(), self::ADR_OPTIONS);
    }

    public function validateUserId(DriverValueObject $driverValueObject): bool
    {
        return (bool) $this->userRepository->findOneBy(['id' => $driverValueObject->getUserId()]);
    }
}
