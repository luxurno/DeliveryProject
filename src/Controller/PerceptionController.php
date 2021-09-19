<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Bundle\ImportDelivery\Exception\MissingResultsException;
use App\Bundle\Perception\Service\PerceptionService;
use App\Bundle\User\Exception\UserNotFound;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class PerceptionController extends AbstractController
{
    /** @var PerceptionService */
    private $perceptionService;

    public function __construct(PerceptionService $perceptionService)
    {
        $this->perceptionService = $perceptionService;
    }

    /**
     * @Route("/api/perception", name="perception-save", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function savePerception(Request $request): Response
    {
        $perceptionData = json_decode($request->getContent(), true);

        $response = new Response();
        try {
            if ([] === $perceptionData['perception']) {
                throw new MissingResultsException('Empty results');
            }

            $this->perceptionService->savePerception($perceptionData['perception']);
            $response->setStatusCode(Response::HTTP_OK);
        } catch (UserNotFound $e) {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        } catch (Throwable $e) {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }

    /**
     * @Route("/api/perception", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function getPerception(Request $request): Response
    {
        $perception = [
            'id' => 1,
            'postal' => '41-200',
            'city' => 'Sosnowiec',
            'street' => 'Paderewskiego',
            'number' => '38',
            'capacity' => '1,2',
            'weight' => '400',
            'lat' => '50.3737032',
            'lng' => '19.2121552',
        ];

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode($perception));

        return $response;
    }
}
