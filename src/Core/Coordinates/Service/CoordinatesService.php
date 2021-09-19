<?php

declare(strict_types = 1);

namespace App\Core\Coordinates\Service;

use App\Bundle\TopCities\Entity\TopCity;
use App\Core\Coordinates\Api\GoogleApiClient;
use App\Core\Coordinates\Mapper\ParamsMapper;
use App\Core\Model\QueueMessage;

class CoordinatesService
{
    /** @var GoogleApiClient */
    private $googleApiClient;

    public function __construct(GoogleApiClient $googleApiClient)
    {
        $this->googleApiClient = $googleApiClient;
    }

    public function askGuGu(QueueMessage $queueMessage): string
    {
        $params = ParamsMapper::get($queueMessage);
        return $this->googleApiClient->getLocation($params);
    }

    public function askGuGuTopCity(TopCity $topCity): string
    {
        $params = ParamsMapper::getByTopCity($topCity);
        return $this->googleApiClient->getLocation($params);
    }
}
