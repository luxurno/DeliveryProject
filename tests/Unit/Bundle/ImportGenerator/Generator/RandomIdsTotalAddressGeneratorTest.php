<?php

declare(strict_types=1);

namespace App\Tests\Unit\Bundle\ImportGenerator\Generator;

use App\Bundle\ImporterGenerator\Generator\RandomIdsTotalAddressGenerator;
use App\Bundle\ImporterGenerator\Provider\TotalAddressCountProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RandomIdsTotalAddressGeneratorTest extends TestCase
{
    /** @var TotalAddressCountProvider&MockObject */
    private $totalAddressCountProvider;

    public function setUp(): void
    {
        $this->totalAddressCountProvider = $this->createMock(TotalAddressCountProvider::class);
    }

    public function testGenerateIds(): void
    {
        $this->totalAddressCountProvider->expects(self::once())
            ->method('provideCountByVoivodeship')
            ->willReturn(100);

        $randomIdsTotalAddressGenerator = new RandomIdsTotalAddressGenerator(
            $this->totalAddressCountProvider
        );

        self::assertCount(
            2,
            $randomIdsTotalAddressGenerator->generateIds(2)
        );
    }
}