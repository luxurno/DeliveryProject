<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Bundle\Route\Service\RouteService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class RouteController extends AbstractController
{
    /** @var RouteService */
    private $routeService;

    public function __construct(RouteService $routeService)
    {
        $this->routeService = $routeService;
    }

    /**
     * @Route("/api/route/{driverId}", name="route")
     * @return Response
     */
    public function getRoute(Request $request, $driverId): Response
    {
        $userId = $request->get('userId', null);

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        try {
            if (false === is_numeric($driverId)) {
                throw new Exception();
            }
            if (false === is_numeric($userId)) {
                throw new Exception();
            }

            $routePreviews = $this->routeService->generateRoute((int) $userId, (int) $driverId);

            $response->setContent(json_encode($routePreviews));
        } catch (NotFoundHttpException $e) {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }

}
