<?php

declare(strict_types = 1);

namespace App\Bundle\ImporterGenerator\Command;

use App\Bundle\ImporterGenerator\Service\ImportGeneratorService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
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
        $this->addArgument('fileName', InputArgument::REQUIRED, 'File name to export in directory /resources/');
        $this->addArgument('rows', InputArgument::REQUIRED, 'Number of rows to export');
        $this->addOption('overwrite', 'o', InputOption::VALUE_OPTIONAL, 'Does file should be overwrite', false);
        $this->addOption('includeReq', 'i', InputOption::VALUE_OPTIONAL, 'Include `id` and `hash` column from `total_address` in exports', false);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->importGeneratorService->generateCsv(
            $input->getArgument('fileName'),
            (int) $input->getArgument('rows'),
            (bool) $input->getOption('overwrite'),
            (bool) $input->getOption('includeReq')
        );

        return 1;
    }
}