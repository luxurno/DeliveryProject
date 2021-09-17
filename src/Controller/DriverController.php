<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Service\DriverService;
use App\Validator\DriverValidator;
use App\ValueObject\DriverValueObject;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DriverController extends AbstractController
{
    /** @var DriverService */
    private $driverService;
    /** @var DriverValidator */
    private $driverValidator;

    public function __construct(
        DriverService $driverService,
        DriverValidator $driverValidator
    )
    {
        $this->driverService = $driverService;
        $this->driverValidator = $driverValidator;
    }

    /**
     * @Route("/api/drivers", name="drivers")
     * @param Request $request
     * @return Response
     */
    public function getDrivers(Request $request): Response
    {
        $userId = $request->get('userId');
        $available = (bool) $request->get('available');

        $users = ($userId !== null) ? $this->driverService->getAllDrivers((int) $userId, $available) : [];

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        $response->setContent(json_encode($users));

        return $response;
    }

    /**
     * @Route("/api/driver/{id}", methods={"DELETE"})
     * @param Request $request
     * @return Response
     */
    public function deleteDriver(Request $request, $id): Response
    {
        $response = new Response();
        try {
            if (false === is_numeric($id)) {
                throw new Exception();
            }

            $driverVO = new DriverValueObject(
                (int) $id
            );

            $this->driverService->deleteDriver($driverVO);
            $response->setStatusCode(Response::HTTP_NO_CONTENT);
        } catch (Exception $e) {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }

    /**
     * @Route("/api/driver", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function createDriver(Request $request): Response
    {
        $driverData = json_decode($request->getContent(), true);

        $driverVO = new DriverValueObject(
            null,
            (int) $driverData['userId'],
            $driverData['name']
        );

        $response = new Response();
        try {
            if (false === $this->driverValidator->validateUserId($driverVO)) {
                throw new Exception();
            }
            $this->driverService->createDriver($driverVO);
            $response->setStatusCode(Response::HTTP_NO_CONTENT);
        } catch (Exception $e) {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }

    /**
     * @Route("/api/driver/config", methods={"PUT"})
     * @param Request $request
     * @return Response
     */
    public function saveDriverConfig(Request $request): Response
    {
        $driverData = json_decode($request->getContent(), true);

        $driverVO = new DriverValueObject(
            (int) $driverData['config']['id'],
            null,
            null,
            (int) $driverData['config']['height'],
            (int) $driverData['config']['length'],
            (int) $driverData['config']['width'],
            (int) $driverData['config']['capacity'],
            strtolower($driverData['config']['adr'])
        );

        $response = new Response();
        try {
            if (false === $this->driverValidator->validateAdr($driverVO)) {
                throw new Exception();
            }

            $this->driverService->saveDriverConfig($driverVO);
            $response->setStatusCode(Response::HTTP_NO_CONTENT);
        } catch (Exception $e) {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }
}
