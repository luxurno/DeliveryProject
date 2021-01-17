<?php

declare(strict_types = 1);

namespace App\Bundle\Generate\Command;

use App\Bundle\Generate\Service\GenerateTrainDatabaseService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateTrainDatabaseCommand extends Command
{
    /** @var GenerateTrainDatabaseService */
    private $generateTrainDatabaseService;

    public function __construct(GenerateTrainDatabaseService $generateTrainDatabaseService)
    {
        $this->generateTrainDatabaseService = $generateTrainDatabaseService;

        parent::__construct();
    }

    public function configure()
    {
        $this->setName('generate:train-db');
        $this->setDescription('Used to generate train db for AI');
        $this->addArgument('fileName', InputArgument::REQUIRED, 'File name to import in directory /resources/');
        $this->addArgument('count', InputArgument::OPTIONAL, 'Number of rows to generate');
        $this->addArgument('from', InputArgument::OPTIONAL, 'Number of id to generate from');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $fileName = $input->getArgument('fileName');
        $count = (int) $input->getArgument('count');
        $from = (int) $input->getArgument('from');

        if ($count !== 0) {
            $this->generateTrainDatabaseService->generateCustomCsv($fileName, $count, $from);
        } else {
            $this->generateTrainDatabaseService->generateCsv();
        }

        return 1;
    }
}