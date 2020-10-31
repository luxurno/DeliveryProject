<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Handler;

use App\Bundle\ImportDelivery\DTO\ImportDeliveryDTO;
use App\Bundle\ImportDelivery\Generator\ImportDeliveryGenerator;
use App\Core\Coordinates\Provider\CoordinatesProvider;
use App\Core\Transformer\QueueMessageTransformer;
use PhpAmqpLib\Message\AMQPMessage;

class ImportDeliveryConsumerHandler
{
    /** @var CoordinatesProvider */
    private $coordinatesProvider;
    /** @var ImportDeliveryGenerator */
    private $importDeliveryGenerator;
    /** @var QueueMessageTransformer */
    private $queueMessageTransformer;

    public function __construct(
        CoordinatesProvider $coordinatesProvider,
        ImportDeliveryGenerator $importDeliveryGenerator,
        QueueMessageTransformer $queueMessageTransformer
    )
    {
        $this->coordinatesProvider = $coordinatesProvider;
        $this->importDeliveryGenerator = $importDeliveryGenerator;
        $this->queueMessageTransformer = $queueMessageTransformer;
    }

    public function handle(AMQPMessage $message): int
    {
        /** @var ImportDeliveryDTO $importDeliveryDTO */
        $importDeliveryDTO = $this->queueMessageTransformer->transformFromQueueMessage($message->getBody());
        $coordinatesDTO = $this->coordinatesProvider->provide($importDeliveryDTO);
        $this->importDeliveryGenerator->update($importDeliveryDTO, $coordinatesDTO);

        return 0;
    }
}
