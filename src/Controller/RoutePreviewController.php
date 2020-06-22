<?php

declare(strict_types = 1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoutePreviewController extends AbstractController
{
    /**
     * @Route("/api/route/preview", name="route")
     * @return Response
     */
    public function getRoute(): Response
    {
        $routePerview = [
            [
                'id' => 1,
                'postal' => '41-200',
                'city' => 'Sosnowiec',
                'street' => 'ul. Józefa Piłsudskiego',
                'number' => '38',
                'house' => null,
            ],
            [
                'id' => 2,
                'postal' => '41-400',
                'city' => 'Mysłowice',
                'street' => 'ul. Jana III Sobieskiego',
                'number' => '17',
                'house' => '1',
            ],
            [
                'id' => 3,
                'postal' => '41-404',
                'city' => 'Mysłowice',
                'street' => 'ul. Słoneczne Wzgórze',
                'number' => '109',
                'house' => null,
            ],
            [
                'id' => 4,
                'postal' => '41-408',
                'city' => 'Mysłowice',
                'street' => 'al. Spacerowa',
                'number' => '2',
                'house' => null,
            ],
            [
                'id' => 5,
                'postal' => '43-100',
                'city' => 'Tychy',
                'street' => 'ul. Wschodnia',
                'number' => '48',
                'house' => null,
            ],
            [
                'id' => 6,
                'postal' => '43-220',
                'city' => 'Świerczyniec',
                'street' => 'ul. Barwna',
                'number' => '58',
                'home' => null,
            ],
            [
                'id' => 7,
                'postal' => '43-220',
                'city' => 'Międzyrzecze',
                'street' => 'ul. Gromadzka',
                'number' => '6',
                'house' => null,
            ],
        ];

        $response = new Response();

        $response->headers->set('Content-Type', 'application/json');
        //$response->headers->set('Access-Control-Allow-Origin', '*');

        $response->setContent(json_encode($routePerview));

        return $response;
    }

}