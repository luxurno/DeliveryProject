<?php

declare(strict_types = 1);

namespace App\Core\Coordinates\Api\Method;

use App\Core\Coordinates\Api\Enum\MethodTypeEnum;

class JsonMethod
{
    private const ENDPOINT = 'json';

    public function getEndpoint(array $params = []): string
    {
        $url = self::ENDPOINT;

        if (count($params) !== 0) {
            $params = 'address=' . urlencode(implode(' ', $params['address']));
            $params .= '&key=AIzaSyAmoNCrb5Zy4EIIGfkVWWXHr9Ev_xKy7Oc';

            $url .= '?' . $params;
        }

        return $url;
    }

    public function getMethodType(): string
    {
        return MethodTypeEnum::GET;
    }
}
