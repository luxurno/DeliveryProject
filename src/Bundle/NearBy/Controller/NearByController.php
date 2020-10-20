<?php

declare(strict_types = 1);

namespace App\Bundle\NearBy\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NearByController extends AbstractController
{
    /**
     * @Route("/api/near-by/preview", name="near-by-preview")
     * @return Response
     */
    public function getNearBy(): Response
    {
        $routePerview = [
            [
                'id' => 1,
                'postal' => '41-200',
                'city' => 'Sosnowiec',
                'street' => 'ul. Józefa Piłsudskiego',
                'number' => '38',
                'house' => null,
                'latitude' => '50.2777032',
                'longitude' => '19.1161552',
            ],
            [
                'id' => 2,
                'postal' => '41-400',
                'city' => 'Mysłowice',
                'street' => 'ul. Jana III Sobieskiego',
                'number' => '17',
                'house' => '1',
                'lat' => '50.2493978',
                'long' => '19.1312617',
            ],
            [
                'id' => 3,
                'postal' => '41-404',
                'city' => 'Mysłowice',
                'street' => 'ul. Słoneczne Wzgórze',
                'number' => '109',
                'house' => null,
                'lat' => '50.2032894',
                'long' => '19.1288553',
            ],
            [
                'id' => 4,
                'postal' => '41-408',
                'city' => 'Mysłowice',
                'street' => 'al. Spacerowa',
                'number' => '2',
                'house' => null,
                'lat' => '50.1894774',
                'long' => '19.1003783',
            ],
            [
                'id' => 5,
                'postal' => '43-100',
                'city' => 'Tychy',
                'street' => 'ul. Wschodnia',
                'number' => '48',
                'house' => null,
                'lat' => '50.1374425',
                'long' => '18.9835517',
            ],
            [
                'id' => 6,
                'postal' => '43-220',
                'city' => 'Świerczyniec',
                'street' => 'ul. Barwna',
                'number' => '58',
                'home' => null,
                'lat' => '50.0658653',
                'long' => '19.0453792',
            ],
            [
                'id' => 7,
                'postal' => '43-220',
                'city' => 'Międzyrzecze',
                'street' => 'ul. Gromadzka',
                'number' => '6',
                'house' => null,
                'lat' => '50.0269784',
                'long' => '19.0619103',
            ],
        ];

        $response = new Response();

        $response->headers->set('Content-Type', 'application/json');
        //$response->headers->set('Access-Control-Allow-Origin', '*');

        $response->setContent(json_encode($routePerview));

        return $response;
    }
}
