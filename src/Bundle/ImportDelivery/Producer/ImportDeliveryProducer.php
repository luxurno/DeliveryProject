<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Producer;

use App\Bundle\ImportDelivery\DTO\ImportDeliveryDTO;
use App\Bundle\ImportDelivery\Producer\Builder\TopicImportDeliveryDTOBuilder;
use App\Core\Rabbit\RabbitClient;
use Throwable;

class ImportDeliveryProducer
{
    /** @var RabbitClient */
    private $rabbitClient;
    /** @var TopicImportDeliveryDTOBuilder */
    private $topicImportDeliveryDTOBuilder;

    public function __construct(
        RabbitClient $rabbitClient,
        TopicImportDeliveryDTOBuilder $topicImportDeliveryDTOBuilder
    )
    {
        $this->rabbitClient = $rabbitClient;
        $this->topicImportDeliveryDTOBuilder = $topicImportDeliveryDTOBuilder;
    }

    public function addQueue(ImportDeliveryDTO $importDeliveryDTO, int $importNumber): void
    {
        try {
            $topicImportDelivery = $this->topicImportDeliveryDTOBuilder->build($importDeliveryDTO, $importNumber);
            $connection = $this->rabbitClient->getConnection();
            $channel = $connection->channel();

            $channel->queue_declare($topicImportDelivery->getTopicName());
            $channel->basic_publish(
                $topicImportDelivery->getTopicContent(),
                '',
                $topicImportDelivery->getTopicName()
            );
        } catch (Throwable $e) {
            // TODO add logger
            throw $e;
        }
    }
}
