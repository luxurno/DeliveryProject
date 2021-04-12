<?php

declare(strict_types = 1);

namespace App\Bundle\ImporterGenerator\Service;

use App\Bundle\ImporterGenerator\Entity\TotalAddress;
use App\Bundle\ImporterGenerator\Enum\ImportFileHeadersEnum;
use App\Bundle\ImporterGenerator\Exception\MissingResultsException;
use App\Bundle\ImporterGenerator\Generator\RandomIdsTotalAddressGenerator;
use App\Bundle\ImporterGenerator\Mapper\TotalAddressMapper;
use App\Bundle\ImporterGenerator\Repository\TotalAddressRepository;
use App\Core\Exception\FileExistException;

class ImportGeneratorService
{
    private const LOCATION = __DIR__ . '/../../../../resources/';

    /** @var RandomIdsTotalAddressGenerator */
    private $randomIdsTotalAddressGenerator;
    /** @var TotalAddressMapper */
    private $totalAddressMapper;
    /** @var TotalAddressRepository */
    private $totalAddressRepository;

    public function __construct(
        RandomIdsTotalAddressGenerator $randomIdsTotalAddressGenerator,
        TotalAddressMapper $totalAddressMapper,
        TotalAddressRepository $totalAddressRepository
    )
    {
        $this->randomIdsTotalAddressGenerator = $randomIdsTotalAddressGenerator;
        $this->totalAddressMapper = $totalAddressMapper;
        $this->totalAddressRepository = $totalAddressRepository;
    }

    public function generateCsv(string $fileName, int $numberRows, bool $overwrite, bool $includeReq): void
    {
        $ids = $this->randomIdsTotalAddressGenerator->generateIds($numberRows);

        $totalAddresses = $this->totalAddressRepository->findBy(['id' => $ids]);
        $this->saveCsvFile($fileName, $totalAddresses, $overwrite, $includeReq);
    }

    private function saveCsvFile(string $fileName, array $totalAddresses, bool $overwrite, bool $includeReq): void
    {
        $filePath = self::LOCATION . $fileName;

        if (false === $overwrite && file_exists($filePath)) {
            throw new FileExistException('File already exists! Use overwrite option to overwrite file');
        }

        if (0 === count($totalAddresses)) {
            throw new MissingResultsException('Missing results from ImportGenerator');
        }

        $fileHandler = fopen($filePath, 'w');

        if ($includeReq) {
            fputcsv($fileHandler, array_merge(['id'], ImportFileHeadersEnum::getAllHeaders(), ['hash']));
        } else {
            fputcsv($fileHandler, ImportFileHeadersEnum::getAllHeaders());
        }

        /** @var TotalAddress $totalAddress */
        foreach ($totalAddresses as $totalAddress) {
            $row = $this->totalAddressMapper->map($includeReq, $totalAddress);

            fputcsv($fileHandler, $row);
        }

        fclose($fileHandler);
    }
}
