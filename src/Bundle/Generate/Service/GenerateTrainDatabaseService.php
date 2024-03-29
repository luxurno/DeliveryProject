<?php

declare(strict_types = 1);

namespace App\Bundle\Generate\Service;

use App\Bundle\Generate\Exception\MissingDatabaseImport;
use App\Bundle\Generate\Parser\GenerateTrainDatabaseAddressParser;
use App\Bundle\ImporterGenerator\Entity\TotalAddress;
use App\Bundle\ImporterGenerator\Provider\TotalAddressCountProvider;
use App\Bundle\ImporterGenerator\Repository\TotalAddressRepository;

ini_set('memory_limit', '2GB');

class GenerateTrainDatabaseService
{
    private const FILE_NAME = 'addressDb.csv';
    private const LOCATION = __DIR__ . '/../../../../ml/resources/Prediction/';
    private const TYPES = ['test', 'train', 'train', 'train'];
    private const HEADERS = ['index', 'type', 'label', 'file', 'review'];
    private const LABELS = ['neg', 'pos', 'neg', 'pos'];
    /** @var TotalAddressCountProvider */
    private $totalAddressCountProvider;
    /** @var TotalAddressRepository */
    private $totalAddressRepository;

    public function __construct(
        TotalAddressCountProvider $totalAddressCountProvider,
        TotalAddressRepository $totalAddressRepository
    )
    {
        $this->totalAddressCountProvider = $totalAddressCountProvider;
        $this->totalAddressRepository = $totalAddressRepository;
    }

    public function generateCustomCsv(string $fileName, int $count, int $from): void
    {
        $numberRange = $this->totalAddressCountProvider->provideCountByVoivodeship();

        if ($numberRange <= 1) {
            throw new MissingDatabaseImport('You need to import Addresses to DB first');
        }

        $fp = fopen(self::LOCATION . $fileName, 'w+');
        fputcsv($fp, self::HEADERS);
        for ($i=$from; $i<= $count+$from; $i++) {
            $type = self::TYPES[3];
            $label = self::LABELS[2];

            /** @var TotalAddress $totalAddress */
            $totalAddress = $this->totalAddressRepository->findOneBy(['id' => $i + 1]);

            $addressDbRow = [
                'index' =>  $i,
                'type' => $type,
                'label' => $label,
                'file' => $totalAddress->getHash() ?? '',
                'review' => GenerateTrainDatabaseAddressParser::getAddress($totalAddress),
            ];
            fputcsv($fp, $addressDbRow);
        }
        fclose($fp);
    }

    public function generateCityCsv(string $fileName, string $city): void
    {
        $fp = fopen(self::LOCATION . $fileName, 'w+');
        fputcsv($fp, self::HEADERS);

        /** @var TotalAddress[] $totalAddresses */
        $totalAddresses = $this->totalAddressRepository->findBy(['city' => $city]);

        foreach ($totalAddresses as $totalAddress) {
            $addressDbRow = [
                'index' =>  $totalAddress->getId(),
                'type' => self::TYPES[0],
                'label' => self::LABELS[1],
                'file' => $totalAddress->getHash() ?: '',
                'review' => GenerateTrainDatabaseAddressParser::getAddress($totalAddress),
            ];
            fputcsv($fp, $addressDbRow);
        }
        fclose($fp);
    }

    public function generateCsv(): void
    {
        $numberRange = $this->totalAddressCountProvider->provideCountByVoivodeship();
        $numberRange = 100000;

        if ($numberRange <= 1) {
            throw new MissingDatabaseImport('You need to import Addresses to DB first');
        }

        $fp = fopen(self::LOCATION . self::FILE_NAME, 'w');
        fputcsv($fp, self::HEADERS);
        for($i=0; $i<=$numberRange; $i++) {
            $example = $i / 25000;
            $example = (int) $example;

            $type = self::TYPES[$example];
            $label = self::LABELS[$example];

//            foreach (self::TYPES as $type) {
//                foreach(self::LABELS as $label) {
                    /** @var TotalAddress $totalAddress */
                    $totalAddress = $this->totalAddressRepository->findOneBy(['id' => $i + 1]);

                    $addressDbRow = [
                        'index' =>  $i,
                        'type' => $type,
                        'label' => $label,
                        'file' => $totalAddress->getHash() ?: '',
                        'review' => GenerateTrainDatabaseAddressParser::getAddress($totalAddress),
                    ];
                    fputcsv($fp, $addressDbRow);
//                    $i++;
//                }
//            }
        }
        fclose($fp);
    }
}