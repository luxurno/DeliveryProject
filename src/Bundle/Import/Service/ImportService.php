<?php

declare(strict_types = 1);

namespace App\Bundle\Import\Service;

use App\Bundle\Import\Entity\Import;
use App\Bundle\Import\Factory\ImportFactory;
use App\Bundle\Import\Repository\ImportRepository;
use App\Bundle\User\Entity\User;
use App\Bundle\User\Exception\UserNotFound;
use App\Bundle\User\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use GuzzleHttp\Exception\InvalidArgumentException;

class ImportService
{
    private const USER_ID = 1;

    /** @var EntityManagerInterface */
    private $em;
    /** @var ImportFactory */
    private $importFactory;
    /** @var ImportRepository */
    private $importRepository;
    /** @var UserRepository */
    private $userRepository;

    public function __construct(
        EntityManagerInterface $em,
        ImportFactory $importFactory,
        ImportRepository $importRepository,
        UserRepository $userRepository
    )
    {
        $this->em = $em;
        $this->importFactory = $importFactory;
        $this->importRepository = $importRepository;
        $this->userRepository = $userRepository;
    }

    public function getImportByDate(string $date): Import
    {
        /** @var User $user */
        $user = $this->userRepository->findOneBy(['id' => self::USER_ID]);
        if ($user === null) {
            throw new UserNotFound(sprintf('User with id `%s` is missing', self::USER_ID));
        }

        /** @var Import $import */
        $import = $this->importRepository->findOneBy(['import_date' => new DateTime($date)]);
        if ($import === null) {
            try {
                $importDate = new DateTime($date);
            } catch (\Exception $e) {
                throw new InvalidArgumentException('Incorrect date');
            }
            $importDate->format('Y-m-d');

            /** @var Import $import */
            $import = $this->importFactory->factory();
            $import->setUser($user);
            $import->setImportDate($importDate);
            $this->em->persist($import);
        }

        return $import;
    }
}
