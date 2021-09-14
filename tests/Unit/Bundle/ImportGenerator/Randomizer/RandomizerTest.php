<?php

declare(strict_types=1);

namespace App\Tests\Unit\Bundle\ImportGenerator\Randomizer;

use App\Bundle\ImporterGenerator\Randomizer\Randomizer;
use PHPUnit\Framework\TestCase;

class RandomizerTest extends TestCase
{
    private const NUMBER_RANGE = 2;

    public function testRandom(): void
    {
        $ids = [1];

        self::assertIsNumeric(
            Randomizer::random($ids, self::NUMBER_RANGE)
        );
    }
}
