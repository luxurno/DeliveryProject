<?php

declare(strict_types=1);

namespace App\Tests\Unit\Bundle\ImportDelivery\Handler;

use App\Bundle\ImportDelivery\DTO\ImportDeliveryDTO;
use App\Bundle\ImportDelivery\Generator\ImportDeliveryGenerator;
use App\Bundle\ImportDelivery\Handler\ImportDeliveryConsumerHandler;
use App\Core\Coordinates\DTO\CoordinatesDTO;
use App\Core\Coordinates\Provider\CoordinatesProvider;
use App\Core\Transformer\QueueMessageTransformer;
use PhpAmqpLib\Message\AMQPMessage;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ImportDeliveryConsumerHandlerTest extends TestCase
{
    private const BODY = '{"body":"test"}';

    /** @var CoordinatesProvider&MockObject */
    private $coordinatesProvider;
    /** @var CoordinatesDTO&MockObject */
    private $coordinatesDTO;
    /** @var ImportDeliveryDTO&MockObject */
    private $importDeliveryDTO;
    /** @var ImportDeliveryGenerator&MockObject */
    private $importDeliveryGenerator;
    /** @var QueueMessageTransformer&MockObject */
    private $queueMessageTransformer;

    protected function setUp(): void
    {
        $this->coordinatesProvider = $this->createMock(CoordinatesProvider::class);
        $this->coordinatesDTO = $this->createMock(CoordinatesDTO::class);
        $this->importDeliveryDTO = $this->createMock(ImportDeliveryDTO::class);
        $this->importDeliveryGenerator = $this->createMock(ImportDeliveryGenerator::class);
        $this->queueMessageTransformer = $this->createMock(QueueMessageTransformer::class);
    }

    public function testHandle(): void
    {
        $amqpMessage = $this->createMock(AMQPMessage::class);
        $amqpMessage->expects(self::once())
            ->method('getBody')
            ->willReturn(self::BODY);

        $this->queueMessageTransformer->expects(self::once())
            ->method('transformFromQueueMessage')
            ->willReturn($this->importDeliveryDTO);

        $this->coordinatesProvider->expects(self::once())
            ->method('provide')
            ->with($this->importDeliveryDTO)
            ->willReturn($this->coordinatesDTO);

        $this->importDeliveryGenerator->expects(self::once())
            ->method('update')
            ->with($this->importDeliveryDTO, $this->coordinatesDTO);

        $importDeliveryConsumerHandler = new ImportDeliveryConsumerHandler(
            $this->coordinatesProvider,
            $this->importDeliveryGenerator,
            $this->queueMessageTransformer
        );

        self::assertEquals(
            0,
            $importDeliveryConsumerHandler->handle($amqpMessage)
        );
    }
}
