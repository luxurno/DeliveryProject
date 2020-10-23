<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Producer\Provider;

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
        return $importNumber % $this->rabbitConfig->getQueueCount();
    }
}
