<?php

declare(strict_types=1);

namespace App\Tests\Unit\Bundle\ImportDelivery\Provider;

use App\Bundle\ImportDelivery\Provider\QueueNumberProvider;
use App\Core\Rabbit\Config\RabbitConfig;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class QueueNumberProviderTest extends TestCase
{
    /** @var RabbitConfig&MockObject */
    private $rabbitConfig;

    protected function setUp(): void
    {
        $this->rabbitConfig = $this->createMock(RabbitConfig::class);
    }

    public function testProvideTopicName(): void
    {
        $this->rabbitConfig->expects(self::once())
            ->method('getQueueCount')
            ->willReturn(3);

        $queueNumberProvider = new QueueNumberProvider(
            $this->rabbitConfig
        );
        self::assertEquals(
            1,
            $queueNumberProvider->provideTopicNumber(3)
        );
    }

    public function testGetQueueLimit(): void
    {

        $this->rabbitConfig->expects(self::once())
            ->method('getQueueCount')
            ->willReturn(3);

        $queueNumberProvider = new QueueNumberProvider(
            $this->rabbitConfig
        );
        self::assertEquals(
            3,
            $queueNumberProvider->getQueueLimit()
        );
    }
}
