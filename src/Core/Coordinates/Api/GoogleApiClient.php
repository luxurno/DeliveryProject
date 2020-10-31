<?php

declare(strict_types = 1);

namespace App\Core\Coordinates\Api;

use App\Core\Coordinates\Api\Method\JsonMethod;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class GoogleApiClient extends Client
{
    private const GOOGLE_URI = 'https://maps.googleapis.com/maps/api/geocode/';

    public function __construct()
    {
        parent::__construct([
            'base_uri' => self::GOOGLE_URI,
        ]);
    }

    public function getLocation(array $params): string
    {
        $method = new JsonMethod();
        try {
            $response = $this->request(
                $method->getMethodType(),
                $method->getEndpoint($params)
            );
        } catch (GuzzleException $e) {
            throw $e;
        }

        return $response->getBody()->getContents();
    }


}
