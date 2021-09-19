<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Command;

use App\Bundle\ImportDelivery\Consumer\ImportDeliveryCoordinatesConsumer;
use App\Core\Enum\QueueDeclareEnum;
use App\Core\Provider\QueueNumberProvider;
use Assert\InvalidArgumentException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportDeliveryCoordinatesCommand extends Command
{
    /** @var ImportDeliveryCoordinatesConsumer */
    private $importDeliveryCoordinatesConsumer;
    /** @var QueueNumberProvider */
    private $queueNumberProvider;

    public function __construct(
        ImportDeliveryCoordinatesConsumer $importDeliveryCoordinatesConsumer,
        QueueNumberProvider $queueNumberProvider
    )
    {
        $this->importDeliveryCoordinatesConsumer = $importDeliveryCoordinatesConsumer;
        $this->queueNumberProvider = $queueNumberProvider;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('import-delivery:coordinates-consumer');
        $this->setDescription('This command is used to run import-delivery coordinates consumer');
        $this->addArgument('queueNumber', InputArgument::REQUIRED, 'queueNumber to consume');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $queueNumber = (int) $input->getArgument('queueNumber');

        if ($this->queueNumberProvider->getQueueLimit() < $queueNumber) {
            throw new InvalidArgumentException('queueNumber is over limit', '400');
        }

        $queueName = sprintf(QueueDeclareEnum::IMPORT_DELIVERY_COORDINATES_UPDATE, $queueNumber);
        $this->importDeliveryCoordinatesConsumer->consume($queueName);

        return 1;
    }
}
