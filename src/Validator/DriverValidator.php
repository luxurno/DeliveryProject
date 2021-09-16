<?php

declare(strict_types = 1);

namespace App\Validator;

use App\Bundle\User\Repository\UserRepository;
use App\Enum\AdrEnum;
use App\ValueObject\DriverValueObject;

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
