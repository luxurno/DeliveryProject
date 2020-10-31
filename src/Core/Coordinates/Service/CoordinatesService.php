<?php

declare(strict_types = 1);

namespace App\Core\Coordinates\Service;

use App\Core\Coordinates\Api\GoogleApiClient;
use App\Core\Coordinates\Mapper\ParamsMapper;
use App\Core\Model\QueueMessage;

class CoordinatesService
{
    /** @var GoogleApiClient */
    private $googleApiClient;
    /** @var ParamsMapper */
    private $paramsMapper;

    public function __construct(
        GoogleApiClient $googleApiClient,
        ParamsMapper $paramsMapper
    )
    {
        $this->googleApiClient = $googleApiClient;
        $this->paramsMapper = $paramsMapper;
    }

    public function askGuGu(QueueMessage $queueMessage): string
    {
        $params = ParamsMapper::get($queueMessage);
        return $this->googleApiClient->getLocation($params);
    }
}
