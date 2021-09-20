<?php

namespace App\Bundle\ImporterGenerator\Command;

use App\Bundle\ImporterGenerator\Service\ImportCityGeneratorService;
use App\Bundle\ImporterGenerator\Service\ImportGeneratorService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImporterCityGeneratorCommand extends Command
{
    /** @var ImportCityGeneratorService */
    private $importCityGeneratorService;

    public function __construct(ImportCityGeneratorService $importCityGeneratorService)
    {
        $this->importCityGeneratorService = $importCityGeneratorService;

        parent::__construct();
    }

    public function configure()
    {
        $this->setName('import:generate-city');
        $this->setDescription('Used to generate random address csv');
        $this->addArgument('voivodeship', InputArgument::REQUIRED, 'Voivodeship');
        $this->addArgument('fileName', InputArgument::REQUIRED, 'File name to export in directory /ml/resources/');
        $this->addArgument('city', InputArgument::REQUIRED, 'City to export');
        $this->addOption('overwrite', 'o', InputOption::VALUE_OPTIONAL, 'Does file should be overwrite', false);
        $this->addOption('includeReq', 'i', InputOption::VALUE_OPTIONAL, 'Include `id` and `hash` column from `total_address` in exports', false);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->importCityGeneratorService->generateCsv(
            $input->getArgument('voivodeship'),
            $input->getArgument('fileName'),
            $input->getArgument('city'),
            (bool) $input->getOption('overwrite'),
            (bool) $input->getOption('includeReq')
        );

        return 1;
    }
}