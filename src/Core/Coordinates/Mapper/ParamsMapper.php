<?php

declare(strict_types = 1);

namespace App\Core\Coordinates\Mapper;

use App\Bundle\TopCities\Entity\TopCity;
use App\Core\Model\QueueMessage;

class ParamsMapper
{
    public static function get(QueueMessage $queueMessage): array
    {
        $params = [
            $queueMessage->getNumber(),
            $queueMessage->getStreet(),
            $queueMessage->getCity(),
            $queueMessage->getPostalCode(),
            $queueMessage->getVoivodeship(),
        ];

        return [
            'key' => 'AIzaSyAmoNCrb5Zy4EIIGfkVWWXHr9Ev_xKy7Oc',
            'address' => array_map(function($param) { return addslashes($param); }, $params),
        ];
    }

    public static function getByTopCity(TopCity $topCity): array
    {
        $params = [
            $topCity->getCity(),
            $topCity->getVoivodeship(),
            $topCity->getCountry(),
        ];

        return [
            'key' => 'AIzaSyAmoNCrb5Zy4EIIGfkVWWXHr9Ev_xKy7Oc',
            'address' => array_map(function($param) { return addslashes($param); }, $params),
        ];
    }
}
