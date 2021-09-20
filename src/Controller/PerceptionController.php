<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Bundle\ImportDelivery\Exception\MissingResultsException;
use App\Bundle\Perception\Service\PerceptionService;
use App\Bundle\User\Exception\UserNotFound;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
     * @Route("/api/perception", methods={"POST"})
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

            $perception = $this->perceptionService->savePerception($perceptionData['perception']);
            $response->setContent(json_encode($perception));
            $response->setStatusCode(Response::HTTP_OK);
        } catch (UserNotFound $e) {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        } catch (Throwable $e) {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }

    /**
     * @Route("/api/perception/{id}", methods={"PUT"})
     * @param Request $request
     * @return Response
     */
    public function editPerception(Request $request, $id): Response
    {
        $driverData = json_decode($request->getContent(), true);

        $response = new Response();
        try {
            if (false === is_numeric($id)) {
                throw new \Exception();
            }
            if (null === $driverData['driverId']) {
                throw new NotFoundHttpException();
            }

            $this->perceptionService->editPerception((int) $id, (int) $driverData['driverId']);
            $response->setStatusCode(Response::HTTP_NO_CONTENT);
        } catch (NotFoundHttpException $e) {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }

    /**
     * @Route("/api/perception/{id}", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function getPerception(Request $request, $id): Response
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        try {
            if (false === is_numeric($id)) {
                throw new \Exception();
            }

            $perception = $this->perceptionService->getPerception((int)$id);
            if (null === $perception) {
                throw new NotFoundHttpException();
            }

            $response->setContent(json_encode($perception));
            $response->setStatusCode(Response::HTTP_OK);
        } catch (NotFoundHttpException $e) {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }
}
