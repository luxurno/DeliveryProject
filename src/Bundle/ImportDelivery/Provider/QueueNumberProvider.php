<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Provider;

use App\Core\Rabbit\Config\RabbitConfig;

class QueueNumberProvider
{
    /** @var RabbitConfig */
    private $rabbitConfig;

    public function __construct(RabbitConfig $rabbitConfig)
    {
        $this->rabbitConfig = $rabbitConfig;
    }

    public function provideTopicNumber(int $importNumber): int
    {
        return $importNumber % $this->rabbitConfig->getQueueCount() + 1;
    }

    public function getQueueLimit(): int
    {
        return $this->rabbitConfig->getQueueCount();
    }
}
