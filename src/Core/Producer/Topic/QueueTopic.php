<?php

declare(strict_types = 1);

namespace App\Core\Producer\Topic;

use PhpAmqpLib\Message\AMQPMessage;

class QueueTopic
{
    /** @var string */
    private $topicName;
    /** @var AMQPMessage */
    private $topicContent;

    public function __construct(string $topicName, AMQPMessage $topicContent)
    {
        $this->topicName = $topicName;
        $this->topicContent = $topicContent;
    }

    public function getTopicName(): string
    {
        return $this->topicName;
    }

    public function getTopicContent(): AMQPMessage
    {
        return $this->topicContent;
    }
}
