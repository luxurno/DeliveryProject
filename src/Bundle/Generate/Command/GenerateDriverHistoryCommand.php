<?php

declare(strict_types = 1);

namespace App\Bundle\Generate\Command;

use App\Bundle\Generate\Service\GenerateDriverHistoryService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateDriverHistoryCommand extends Command
{
    /** @var GenerateDriverHistoryService */
    private $generateDriverHistoryService;

    public function __construct(GenerateDriverHistoryService $generateDriverHistoryService)
    {
        $this->generateDriverHistoryService = $generateDriverHistoryService;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('generate:from-resource');
        $this->setDescription('Used to generate train db for AI');
        $this->addArgument('fileName', InputArgument::REQUIRED, 'File name to import in directory /resources/');
        $this->addArgument('fromFileName', InputArgument::REQUIRED, 'File name to import based with in directory /ml/resources/');
        $this->addOption('overwrite', 'o', InputOption::VALUE_OPTIONAL, 'Set to true to overwrite file', false);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fileName = $input->getArgument('fileName');
        $fromFileName = $input->getArgument('fromFileName');
        $overwrite = (bool) $input->getOption('overwrite');

        $this->generateDriverHistoryService->generateCsv(
            $fileName,
            $fromFileName,
            $overwrite
        );

        return 1;
    }
}
