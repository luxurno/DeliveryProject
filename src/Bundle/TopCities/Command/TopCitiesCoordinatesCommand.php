<?php

declare(strict_types=1);

namespace App\Bundle\TopCities\Command;

use App\Bundle\TopCities\Service\TopCitiesCoordinatesService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TopCitiesCoordinatesCommand extends Command
{
    /** @var TopCitiesCoordinatesService */
    private $topCitiesCoordinatesService;

    public function __construct(TopCitiesCoordinatesService $topCitiesCoordinatesService)
    {
        $this->topCitiesCoordinatesService = $topCitiesCoordinatesService;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('top-cities:update-coordinates');
        $this->setDescription('This command is used for download coordinates for top cities');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->topCitiesCoordinatesService->updateTopCities();

        return 1;
    }
}