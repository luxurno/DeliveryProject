<?php

namespace App\Tests\Unit\Bundle\Generate\Analyzer;

use App\Bundle\Generate\Analyzer\TypeAnalyzer;
use PHPUnit\Framework\TestCase;

class TypeAnalyzerTest extends TestCase
{
    public function testAnalyzeTrain(): void
    {
        $numberOf = 20;
        $total = 100;

        $typeAnalyzer = new TypeAnalyzer();
        self::assertEquals(
            TypeAnalyzer::TEST,
            $typeAnalyzer->analyze($numberOf, $total)
        );
    }

    public function testAnalyzeTest(): void
    {
        $numberOf = 80;
        $total = 100;

        $typeAnalyzer = new TypeAnalyzer();
        self::assertEquals(
            TypeAnalyzer::TRAIN,
            $typeAnalyzer->analyze($numberOf, $total)
        );
    }
}
