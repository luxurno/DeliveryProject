<?php

declare(strict_types = 1);

namespace App\Bundle\ImporterGenerator\Command;

use App\Bundle\ImporterGenerator\Service\ImportGeneratorService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImporterGeneratorCommand extends Command
{
    /** @var ImportGeneratorService */
    private $importGeneratorService;

    public function __construct(ImportGeneratorService $importGeneratorService)
    {
        $this->importGeneratorService = $importGeneratorService;

        parent::__construct();
    }

    public function configure()
    {
        $this->setName('import:generate-csv');
        $this->setDescription('Used to generate random address csv');
        $this->addArgument('rows', InputArgument::REQUIRED, 'Number of rows to export');
        $this->addArgument('fileName', InputArgument::REQUIRED, 'File name to export in directory /resources/');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->importGeneratorService->generateCsv(
            (int) $input->getArgument('rows'),
            $input->getArgument('fileName')
        );

        return 1;
    }
}