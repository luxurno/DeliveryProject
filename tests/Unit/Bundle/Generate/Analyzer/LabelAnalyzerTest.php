<?php

namespace App\Tests\Unit\Bundle\Generate\Analyzer;

use App\Bundle\Generate\Analyzer\LabelAnalyzer;
use App\Bundle\Generate\DTO\GenerateDTO;
use PHPUnit\Framework\TestCase;

class LabelAnalyzerTest extends TestCase
{
    /** @var array */
    private $driverHistoryData;
    /** @var array */
    private $warehouseData;

    protected function setUp(): void
    {
        $this->driverHistoryData = [
            'id' => 1,
            'country' => 'Polska',
            'district' => 'raciborski',
            'community' => 'Kuźnia Raciborska',
            'city' => 'Jankowice',
            'street' => 'Wiejska',
            'number' => '8',
            'postal_code' => '47-430',
            'hash' => '0bc734cf140f43bbcd5dc8d87a0c27e33d1437e0',
        ];

        $this->warehouseData = [
            'id' => 12,
            'country' => 'Polska',
            'district' => 'raciborski',
            'community' => 'Kuźnia Raciborska',
            'city' => 'Jankowice',
            'street' => 'Wiejska',
            'number' => '8',
            'postal_code' => '47-430',
            'hash' => '0bc734cf140f43bbcd5dc8d87a0c27e33d1437e0',
        ];
    }

    public function testAnalyzePositive(): void
    {
        $generateDTO = new GenerateDTO($this->driverHistoryData);
        $warehousePackages = [new GenerateDTO($this->warehouseData)];

        $labelAnalyzer = new LabelAnalyzer();
        $analyzed = $labelAnalyzer->analyze($generateDTO, $warehousePackages);
        self::assertEquals(LabelAnalyzer::POSITIVE, $analyzed);
    }

    public function testAnalyzeNegative(): void
    {
        $this->warehouseData['city'] = 'Rudy';

        $generateDTO = new GenerateDTO($this->driverHistoryData);
        $warehousePackages = [new GenerateDTO($this->warehouseData)];

        $labelAnalyzer = new LabelAnalyzer();
        $analyzed = $labelAnalyzer->analyze($generateDTO, $warehousePackages);
        self::assertEquals(LabelAnalyzer::NEGATIVE, $analyzed);
    }
}
