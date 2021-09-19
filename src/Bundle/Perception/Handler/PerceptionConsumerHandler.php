<?php

namespace App\Bundle\Perception\Handler;

use App\Bundle\Perception\DTO\PerceptionDTO;
use App\Bundle\Perception\Generator\PerceptionGenerator;
use App\Core\Coordinates\Provider\CoordinatesProvider;
use App\Core\Transformer\QueueMessageTransformer;
use PhpAmqpLib\Message\AMQPMessage;

class PerceptionConsumerHandler
{
    /** @var CoordinatesProvider */
    private $coordinatesProvider;
    /** @var PerceptionGenerator */
    private $perceptionGenerator;
    /** @var QueueMessageTransformer */
    private $queueMessageTransformer;

    public function __construct(
        CoordinatesProvider $coordinatesProvider,
        PerceptionGenerator $perceptionGenerator,
        QueueMessageTransformer $queueMessageTransformer
    )
    {
        $this->coordinatesProvider = $coordinatesProvider;
        $this->perceptionGenerator = $perceptionGenerator;
        $this->queueMessageTransformer = $queueMessageTransformer;
    }

    public function handle(AMQPMessage $message): int
    {
        /** @var PerceptionDTO $perceptionDTO */
        $perceptionDTO = $this->queueMessageTransformer->transformFromQueueMessage($message->getBody());
        $coordinatesDTO = $this->coordinatesProvider->provide($perceptionDTO);
        $this->perceptionGenerator->update($perceptionDTO, $coordinatesDTO);

        return 0;
    }
}