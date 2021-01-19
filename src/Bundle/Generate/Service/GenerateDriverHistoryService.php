<?php

declare(strict_types = 1);

namespace App\Bundle\Generate\Service;

use App\Bundle\Generate\Analyzer\LabelAnalyzer;
use App\Bundle\Generate\Analyzer\TypeAnalyzer;
use App\Bundle\Generate\DTO\GenerateDTO;
use App\Bundle\Generate\Enum\DriverHistoryHeadersEnum;
use App\Bundle\Generate\Parser\GenerateDTOParser;
use App\Bundle\Generate\Provider\GenerateDTOProvider;
use App\Bundle\ImporterGenerator\Enum\ImportFileHeadersEnum;
use App\Core\Exception\FileExistException;

class GenerateDriverHistoryService
{
    private const RESOURCE_LOCATION = __DIR__ . '/../../../../resources/';
    private const ML_RESOURCE_LOCATION = __DIR__ . '/../../../../ml/resources/';
    /** @var GenerateDTOProvider */
    private $generateDTOProvider;
    /** @var LabelAnalyzer */
    private $labelAnalyzer;
    /** @var TypeAnalyzer */
    private $typeAnalyzer;

    public function __construct(
        GenerateDTOProvider $generateDTOProvider,
        LabelAnalyzer $labelAnalyzer,
        TypeAnalyzer $typeAnalyzer
    )
    {
        $this->generateDTOProvider = $generateDTOProvider;
        $this->labelAnalyzer = $labelAnalyzer;
        $this->typeAnalyzer = $typeAnalyzer;
    }

    public function generateCsv(string $fileName, string $fromFileName, bool $overwrite = false): void
    {
        $filePath = self::RESOURCE_LOCATION . $fileName;
        $fromFilePath = self::RESOURCE_LOCATION . $fromFileName;

        if (false === $overwrite && file_exists($filePath)) {
            throw new FileExistException('File already exists! Use overwrite option to overwrite file');
        }

        if (false === file_exists($fromFilePath)) {
            throw new FileExistException('File to generate import based on doesn\'t exists!');
        }

        $driverHistories = $this->generateDTOProvider->provide($filePath);
        $warehousePackages = $this->generateDTOProvider->provide($fromFilePath);

        $driverHistoriesTotal = count($driverHistories);

        // Save $filePath file
        $filePath = self::ML_RESOURCE_LOCATION . $fileName;
        $fp = fopen($filePath, 'w');
        fputcsv($fp, DriverHistoryHeadersEnum::getAll());
        /** @var GenerateDTO $driverHistory */
        foreach ($driverHistories as $index => $driverHistory) {
            $type = $this->typeAnalyzer->analyze($index, $driverHistoriesTotal);
            $label = $this->labelAnalyzer->analyze($driverHistory, $warehousePackages);

            $row = [
                DriverHistoryHeadersEnum::INDEX => $index,
                DriverHistoryHeadersEnum::TYPE => $type,
                DriverHistoryHeadersEnum::LABEL => $label,
                DriverHistoryHeadersEnum::FILE => $driverHistory->getHash(),
                DriverHistoryHeadersEnum::REVIEW => GenerateDTOParser::parse($driverHistory),
            ];
            fputcsv($fp, $row);
        }
        fclose($fp);

        // Save $fromFilePath
        $fromFilePath = self::ML_RESOURCE_LOCATION . $fromFileName;
        $fp = fopen($fromFilePath, 'w');
        fputcsv($fp, ImportFileHeadersEnum::getAll());
        /** @var GenerateDTO $driverHistory */
        foreach ($warehousePackages as $warehousePackage) {
            fputcsv($fp, [GenerateDTOParser::parse($warehousePackage)]);
        }
        fclose($fp);
    }
}