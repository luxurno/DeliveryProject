<?php

declare(strict_types=1);

namespace App\Tests\Unit\Bundle\ImportDelivery\Producer;

use App\Bundle\ImportDelivery\DTO\ImportDeliveryDTO;
use App\Bundle\ImportDelivery\Producer\Builder\TopicImportDeliveryDTOBuilder;
use App\Bundle\ImportDelivery\Producer\ImportDeliveryProducer;
use App\Core\Rabbit\RabbitClient;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exception\AMQPConnectionClosedException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ImportDeliveryProducerTest extends TestCase
{
    /** @var ImportDeliveryDTO&MockObject */
    private $importDeliveryDTO;
    /** @var RabbitClient&MockObject */
    private $rabbitClient;
    /** @var TopicImportDeliveryDTOBuilder&MockObject */
    private $topicImportDeliveryDTOBuilder;

    protected function setUp(): void
    {
        $this->importDeliveryDTO = $this->createMock(ImportDeliveryDTO::class);
        $this->rabbitClient = $this->createMock(RabbitClient::class);
        $this->topicImportDeliveryDTOBuilder = $this->createMock(TopicImportDeliveryDTOBuilder::class);
    }

    public function testAddQueue(): void
    {
        $connection = $this->createMock(AMQPStreamConnection::class);
        $channel = $this->createMock(AMQPChannel::class);

        $this->rabbitClient->expects(self::once())
            ->method('getConnection')
            ->willReturn($connection);
        $connection->expects(self::once())
            ->method('channel')
            ->willReturn($channel);

        $channel->expects(self::once())
            ->method('queue_declare');
        $channel->expects(self::once())
            ->method('basic_publish');

        $importDeliveryProducer = new ImportDeliveryProducer(
            $this->rabbitClient,
            $this->topicImportDeliveryDTOBuilder
        );
        $importDeliveryProducer->addQueue(
            $this->importDeliveryDTO,
            0
        );
    }

    public function testAddQueueException(): void
    {

        $connection = $this->createMock(AMQPStreamConnection::class);
        $channel = $this->createMock(AMQPChannel::class);

        $this->rabbitClient->expects(self::once())
            ->method('getConnection')
            ->willReturn($connection);
        $connection->expects(self::once())
            ->method('channel')
            ->willReturn($channel);

        $channel->expects(self::once())
            ->method('queue_declare');
        $channel->expects(self::once())
            ->method('basic_publish')
            ->willThrowException(new AMQPConnectionClosedException());

        $this->expectException(AMQPConnectionClosedException::class);

        $importDeliveryProducer = new ImportDeliveryProducer(
            $this->rabbitClient,
            $this->topicImportDeliveryDTOBuilder
        );
        $importDeliveryProducer->addQueue(
            $this->importDeliveryDTO,
            0
        );
    }
}
