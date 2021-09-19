<?php

declare(strict_types=1);

namespace App\Bundle\Perception\Producer;

use App\Bundle\Perception\DTO\PerceptionDTO;
use App\Bundle\Perception\Producer\Builder\TopicPerceptionDTOBuilder;
use App\Core\Rabbit\RabbitClient;
use Throwable;

class PerceptionProducer
{
    /** @var RabbitClient */
    private $rabbitClient;
    /** @var TopicPerceptionDTOBuilder */
    private $topicPerceptionDTOBuilder;

    public function __construct(
        RabbitClient $rabbitClient,
        TopicPerceptionDTOBuilder $topicPerceptionDTOBuilder
    ) {
        $this->rabbitClient = $rabbitClient;
        $this->topicPerceptionDTOBuilder = $topicPerceptionDTOBuilder;
    }

    public function addQueue(PerceptionDTO $perceptionDTO): void
    {
        try {
            $topic = $this->topicPerceptionDTOBuilder->build($perceptionDTO);
            $connection = $this->rabbitClient->getConnection();
            $channel = $connection->channel();

            $channel->queue_declare($topic->getTopicName());
            $channel->basic_publish(
                $topic->getTopicContent(),
                '',
                $topic->getTopicName()
            );
        } catch (Throwable $e) {
            // TODO add logger
            throw $e;
        }
    }
}
