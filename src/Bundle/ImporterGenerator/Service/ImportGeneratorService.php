<?php

declare(strict_types = 1);

namespace App\Bundle\ImporterGenerator\Service;

use App\Bundle\ImporterGenerator\Entity\TotalAddress;
use App\Bundle\ImporterGenerator\Enum\ImportFileHeadersEnum;
use App\Bundle\ImporterGenerator\Exception\MissingResultsException;
use App\Bundle\ImporterGenerator\Generator\RandomIdsTotalAddressGenerator;
use App\Bundle\ImporterGenerator\Provider\TotalAddressCountProvider;
use App\Bundle\ImporterGenerator\Repository\TotalAddressRepository;

class ImportGeneratorService
{
    private const LOCATION = __DIR__ . '/../../../../var/';

    /** @var RandomIdsTotalAddressGenerator */
    private $randomIdsTotalAddressGenerator;
    /** @var TotalAddressRepository */
    private $totalAddressRepository;

    public function __construct(
        RandomIdsTotalAddressGenerator $randomIdsTotalAddressGenerator,
        TotalAddressRepository $totalAddressRepository
    )
    {
        $this->randomIdsTotalAddressGenerator = $randomIdsTotalAddressGenerator;
        $this->totalAddressRepository = $totalAddressRepository;
    }

    public function generateCsv(int $numberRows, string $fileName): void
    {
        $ids = $this->randomIdsTotalAddressGenerator->generateIds($numberRows);

        $totalAddresses = $this->totalAddressRepository->findBy(['id' => $ids]);
        $this->saveCsvFile($fileName, $totalAddresses);
    }

    private function saveCsvFile(string $fileName, array $totalAddresses): void
    {
        if (count($totalAddresses) === 0) {
            throw new MissingResultsException('Missing results from ImportGenerator');
        }

        $filePath = self::LOCATION . $fileName;

        $fileHandler = fopen($filePath, 'a');
        fputcsv($fileHandler, ImportFileHeadersEnum::getAll());

        /** @var TotalAddress $totalAddress */
        foreach ($totalAddresses as $totalAddress) {
            $row = [
                ImportFileHeadersEnum::COUNTRY => $totalAddress->getKraj(),
                ImportFileHeadersEnum::DISTRICT => $totalAddress->getPowiat(),
                ImportFileHeadersEnum::COMMUNITY => $totalAddress->getGmina(),
                ImportFileHeadersEnum::CITY => $totalAddress->getMiasto(),
                ImportFileHeadersEnum::STREET => $totalAddress->getUlica(),
                ImportFileHeadersEnum::NUMBER => $totalAddress->getNumer(),
                ImportFileHeadersEnum::POSTAL_CODE => $totalAddress->getKodPocztowy(),
            ];

            fputcsv($fileHandler, $row);
        }

        fclose($fileHandler);
    }
}
