<?php

declare(strict_types = 1);

namespace App\Bundle\Generate\Analyzer;

class TypeAnalyzer
{
    private const PERCENTAGE = 75;
    private const TRAIN = 'train';
    private const TEST = 'test';

    public function analyze(int $numberOf, int $total): string
    {
        return (self::PERCENTAGE < (($numberOf * 100) / $total)) ? self::TRAIN : self::TEST;
    }
}