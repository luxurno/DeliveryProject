<?php

declare(strict_types = 1);

namespace App\Bundle\Perception\Controller;

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
     * @Route("/api/perception/save", name="perception-save")
     * @param Request $request
     * @return Response
     * @throws MissingResultsException
     */
    public function savePerception(Request $request): Response
    {
        $perceptionData = json_decode($request->getContent(), true);

        if ($perceptionData['perception'] === []) {
            throw new MissingResultsException('Empty results');
        }

        $response = new Response();
        try {
            $this->perceptionService->savePerception($perceptionData['perception']);
        } catch (UserNotFound $e) {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        } catch (Throwable $e) {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }
}
