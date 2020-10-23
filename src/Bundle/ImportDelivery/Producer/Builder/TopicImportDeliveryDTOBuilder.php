<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Producer\Builder;

use App\Bundle\ImportDelivery\DTO\ImportDeliveryDTO;
use App\Bundle\ImportDelivery\Producer\Builder\Topic\ImportDeliveryTopic;
use App\Bundle\ImportDelivery\Producer\Provider\QueueNumberProvider;
use PhpAmqpLib\Message\AMQPMessage;

class TopicImportDeliveryDTOBuilder
{
    private const TOPIC_NAME = 'import_delivery_%s';

    /** @var QueueNumberProvider */
    private $queueNumberProvider;

    public function __construct(QueueNumberProvider $queueNumberProvider)
    {
        $this->queueNumberProvider = $queueNumberProvider;
    }

    public function build(ImportDeliveryDTO $importDeliveryDTO, int $importNumber): ImportDeliveryTopic
    {
        $topicName = sprintf(
            self::TOPIC_NAME,
            $this->queueNumberProvider->provideTopicNumber($importNumber)
        );
        $topicContent = new AMQPMessage(serialize($importDeliveryDTO));

        return new ImportDeliveryTopic($topicName, $topicContent);
    }
}
