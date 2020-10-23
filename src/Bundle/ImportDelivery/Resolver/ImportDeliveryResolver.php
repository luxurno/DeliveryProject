<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Resolver;

use App\Bundle\Import\Service\ImportService;
use App\Bundle\ImportDelivery\Filter\ImportDeliveryFilter;
use App\Bundle\ImportDelivery\Service\ImportDeliveryService;
use App\Bundle\ImportDelivery\Validator\ImportDeliveryValidator;
use DateTime;

class ImportDeliveryResolver
{
    /** @var ImportDeliveryFilter */
    private $importDeliveryFilter;
    /** @var ImportDeliveryService */
    private $importDeliveryService;
    /** @var ImportDeliveryValidator */
    private $importDeliveryValidator;
    /** @var ImportService */
    private $importService;

    public function __construct(
        ImportDeliveryFilter $importDeliveryFilter,
        ImportDeliveryService $importDeliveryService,
        ImportDeliveryValidator $importDeliveryValidator,
        ImportService $importService
    )
    {
        $this->importDeliveryFilter = $importDeliveryFilter;
        $this->importDeliveryService = $importDeliveryService;
        $this->importDeliveryValidator = $importDeliveryValidator;
        $this->importService = $importService;
    }

    public function resolve(array $importData): void
    {
        $date = new DateTime();
        $headers = $this->importDeliveryFilter->filterHeaders($importData);
        $import = $this->importService->getImportByDate($date->format('Y-m-d'));

        foreach ($importData['data'] as $index => $data) {
            if ($this->importDeliveryValidator->validate($headers, $data['data'])) {
                $data = array_combine($headers, $data['data']);
                $this->importDeliveryService->createImportDelivery($import, $data, $index);
            }
        }
    }
}
