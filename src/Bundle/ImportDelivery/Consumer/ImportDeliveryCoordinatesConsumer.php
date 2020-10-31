<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Consumer;

use App\Bundle\ImportDelivery\Handler\ImportDeliveryConsumerHandler;
use App\Core\Rabbit\RabbitClient;
use PhpAmqpLib\Exception\AMQPChannelClosedException;
use Throwable;

class ImportDeliveryCoordinatesConsumer
{
    /** @var ImportDeliveryConsumerHandler */
    private $importDeliveryConsumerHandler;
    /** @var RabbitClient */
    private $rabbitClient;

    public function __construct(
        ImportDeliveryConsumerHandler $importDeliveryConsumerHandler,
        RabbitClient $rabbitClient
    )
    {
        $this->importDeliveryConsumerHandler = $importDeliveryConsumerHandler;
        $this->rabbitClient = $rabbitClient;
    }

    public function consume(string $queueName): void
    {
        try {
            $connection = $this->rabbitClient->getConnection();
            $channel = $connection->channel();

            $channel->basic_consume(
                $queueName,
                '',
                false,
                true,
                false,
                false,
                [$this->importDeliveryConsumerHandler, 'handle']
            );

            while ($channel->is_consuming()) {
                $channel->wait();
            }
        } catch (AMQPChannelClosedException $e) {
            // for now;
        }
    }
}
