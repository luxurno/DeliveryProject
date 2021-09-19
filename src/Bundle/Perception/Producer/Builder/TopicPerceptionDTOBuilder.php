<?php

declare(strict_types=1);

namespace App\Bundle\Perception\Producer\Builder;

use App\Bundle\Perception\DTO\PerceptionDTO;
use App\Core\Enum\QueueDeclareEnum;
use App\Core\Producer\Topic\QueueTopic;
use App\Core\Provider\QueueNumberProvider;
use App\Core\Transformer\QueueMessageTransformer;
use PhpAmqpLib\Message\AMQPMessage;

class TopicPerceptionDTOBuilder
{
    /** @var QueueMessageTransformer */
    private $queueMessageTransformer;
    /** @var QueueNumberProvider */
    private $queueNumberProvider;

    public function __construct(
        QueueMessageTransformer $queueMessageTransformer,
        QueueNumberProvider $queueNumberProvider
    )
    {
        $this->queueMessageTransformer = $queueMessageTransformer;
        $this->queueNumberProvider = $queueNumberProvider;
    }

    public function build(PerceptionDTO $perceptionDTO): QueueTopic
    {
        $topicName = sprintf(
            QueueDeclareEnum::PERCEPTION_COORDINATES_UPDATE,
            $this->queueNumberProvider->provideTopicNumber(1)
        );
        $topicContent = new AMQPMessage(
            $this->queueMessageTransformer->transformToQueueMessage($perceptionDTO)
        );

        return new QueueTopic($topicName, $topicContent);
    }
}