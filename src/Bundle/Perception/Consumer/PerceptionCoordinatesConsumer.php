<?php

declare(strict_types=1);

namespace App\Bundle\Perception\Consumer;

use App\Bundle\Perception\Handler\PerceptionConsumerHandler;
use App\Core\Rabbit\RabbitClient;
use PhpAmqpLib\Exception\AMQPChannelClosedException;

class PerceptionCoordinatesConsumer
{
    /** @var PerceptionConsumerHandler */
    private $perceptionConsumerHandler;
    /** @var RabbitClient */
    private $rabbitClient;

    public function __construct(
        PerceptionConsumerHandler $perceptionConsumerHandler,
        RabbitClient $rabbitClient
    )
    {
        $this->perceptionConsumerHandler = $perceptionConsumerHandler;
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
                [$this->perceptionConsumerHandler, 'handle']
            );

            while ($channel->is_consuming()) {
                $channel->wait();
            }
        } catch (AMQPChannelClosedException $e) {
            // for now;
        }
    }
}