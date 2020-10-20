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
                'name' => 'Andrzej Kowalski',
                'image' => 'https://randomuser.me/api/portraits/men/42.jpg',
                'height' => 270,
                'width' => 230,
                'capacity' => 1300,
                'adr' => 'tak',
                'area' => [
                    [
                        'lat' => '50.2977032',
                        'lng' => '19.1265552',
                    ],
                    [
                        'lat' => '50.2673032',
                        'lng' => '19.1191552',
                    ],
                    [
                        'lat' => '50.1777032',
                        'lng' => '19.1261552',
                    ],
                ],
            ],
            [
                'id' => 2,
                'name' => 'Karol Kowalski',
                'image' => 'https://randomuser.me/api/portraits/men/43.jpg',
                'height' => 280,
                'width' => 220,
                'capacity' => 1000,
                'adr' => 'nie',
                'area' => [
                    [
                        'lat' => '50.1894774',
                        'lng' => '19.1003783',
                    ],
                    [
                        'lat' => '50.2473032',
                        'lng' => '19.1123783',
                    ],
                    [
                        'lat' => '50.2894774',
                        'lng' => '19.1043783',
                    ],
                ],
            ],
            [
                'id' => 3,
                'name' => 'Czarek Szpak',
                'image' => 'https://randomuser.me/api/portraits/men/53.jpg',
                'height' => 290,
                'width' => 220,
                'capacity' => 900,
                'adr' => 'nie',
                'area' => [
                    [
                        'lat' => '50.1374425',
                        'lng' => '18.9835517',
                    ],
                    [
                        'lat' => '50.1774425',
                        'lng' => '18.9955517',
                    ],
                    [
                        'lat' => '50.1615425',
                        'lng' => '18.9736417',
                    ],
                ],
            ],
        ];

        $response = new Response();

        $response->headers->set('Content-Type', 'application/json');
        //$response->headers->set('Access-Control-Allow-Origin', '*');

        $response->setContent(json_encode($routePerview));

        return $response;
    }
}
