<?php

declare(strict_types=1);

namespace App\Bundle\Perception\Command;

use App\Bundle\ImportDelivery\Consumer\ImportDeliveryCoordinatesConsumer;
use App\Bundle\Perception\Consumer\PerceptionCoordinatesConsumer;
use App\Core\Enum\QueueDeclareEnum;
use App\Core\Provider\QueueNumberProvider;
use Assert\InvalidArgumentException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PerceptionCoordinatesCommand extends Command
{
    /** @var PerceptionCoordinatesConsumer */
    private $perceptionCoordinatesConsumer;
    /** @var QueueNumberProvider */
    private $queueNumberProvider;

    public function __construct(
        PerceptionCoordinatesConsumer $perceptionCoordinatesConsumer,
        QueueNumberProvider $queueNumberProvider
    )
    {
        $this->perceptionCoordinatesConsumer = $perceptionCoordinatesConsumer;
        $this->queueNumberProvider = $queueNumberProvider;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('perception:coordinates-consumer');
        $this->setDescription('This command is used to run perception coordinates consumer');
        $this->addArgument('queueNumber', InputArgument::REQUIRED, 'queueNumber to consume');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $queueNumber = (int) $input->getArgument('queueNumber');

        if ($this->queueNumberProvider->getQueueLimit() < $queueNumber) {
            throw new InvalidArgumentException('queueNumber is over limit', '400');
        }

        $queueName = sprintf(QueueDeclareEnum::PERCEPTION_COORDINATES_UPDATE, $queueNumber);
        $this->perceptionCoordinatesConsumer->consume($queueName);

        return 1;
    }
}
