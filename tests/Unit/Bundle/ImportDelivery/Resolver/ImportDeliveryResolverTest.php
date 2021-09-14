<?php

declare(strict_types=1);

namespace App\Tests\Unit\Bundle\ImportDelivery\Resolver;

use App\Bundle\Import\Service\ImportService;
use App\Bundle\ImportDelivery\Filter\ImportDeliveryFilter;
use App\Bundle\ImportDelivery\Resolver\ImportDeliveryResolver;
use App\Bundle\ImportDelivery\Service\ImportDeliveryService;
use App\Bundle\ImportDelivery\Validator\ImportDeliveryValidator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ImportDeliveryResolverTest extends TestCase
{
    /** @var ImportDeliveryFilter&MockObject */
    private $importDeliveryFilter;
    /** @var ImportDeliveryService&MockObject */
    private $importDeliveryService;
    /** @var ImportDeliveryValidator&MockObject */
    private $importDeliveryValidator;
    /** @var ImportService&MockObject */
    private $importService;

    protected function setUp(): void
    {
        $this->importDeliveryFilter = $this->createMock(ImportDeliveryFilter::class);
        $this->importDeliveryService = $this->createMock(ImportDeliveryService::class);
        $this->importDeliveryValidator = $this->createMock(ImportDeliveryValidator::class);
        $this->importService = $this->createMock(ImportService::class);
    }

    public function testResolve(): void
    {
        $importData = [
            'importDate' => '2021-09-09',
            'data' => [
                [
                    'data' => []
                ]
            ]
        ];

        $this->importDeliveryFilter->expects(self::once())
            ->method('filterHeaders');
        $this->importService->expects(self::once())
            ->method('getImportByDate')
            ->with('2021-09-09');

        $this->importDeliveryValidator->expects(self::once())
            ->method('validate')
            ->willReturn(true);
        $this->importDeliveryService->expects(self::once())
            ->method('createImportDelivery');

        $importDeliveryResolver = new ImportDeliveryResolver(
            $this->importDeliveryFilter,
            $this->importDeliveryService,
            $this->importDeliveryValidator,
            $this->importService
        );
        $importDeliveryResolver->resolve($importData);
    }
}