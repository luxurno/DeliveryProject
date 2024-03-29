<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Producer\Builder;

use App\Bundle\ImportDelivery\DTO\ImportDeliveryDTO;
use App\Core\Enum\QueueDeclareEnum;
use App\Core\Producer\Topic\QueueTopic;
use App\Core\Provider\QueueNumberProvider;
use App\Core\Transformer\QueueMessageTransformer;
use PhpAmqpLib\Message\AMQPMessage;

class TopicImportDeliveryDTOBuilder
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

    public function build(ImportDeliveryDTO $importDeliveryDTO, int $importNumber): QueueTopic
    {
        $topicName = sprintf(
            QueueDeclareEnum::IMPORT_DELIVERY_COORDINATES_UPDATE,
            $this->queueNumberProvider->provideTopicNumber($importNumber)
        );
        $topicContent = new AMQPMessage(
            $this->queueMessageTransformer->transformToQueueMessage($importDeliveryDTO)
        );

        return new QueueTopic($topicName, $topicContent);
    }
}
