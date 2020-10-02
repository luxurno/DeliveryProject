<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Service\DriverService;
use App\Validator\DriverValidator;
use App\ValueObject\DriverValueObject;
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
     * @Route("/api/drivers", name="users")
     * @return Response
     */
    public function getDrivers(): Response
    {
        $users = $this->driverService->getAllDrivers();

        $response = new Response();

        $response->headers->set('Content-Type', 'application/json');
        //$response->headers->set('Access-Control-Allow-Origin', '*');

        $response->setContent(json_encode($users));

        return $response;
    }

    /**
     * @Route("/api/driver/save", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function saveDriverConfig(Request $request): Response
    {
        $driverData = json_decode($request->getContent(), true);

        $driverVO = new DriverValueObject(
            (int) $driverData['config']['id'],
            (int) $driverData['config']['height'],
            (int) $driverData['config']['width'],
            (int) $driverData['config']['capacity'],
            strtolower($driverData['config']['adr'])
        );

        $response = new Response();
        try {
            if (false === $this->driverValidator->validateAdr($driverVO)) {
                throw new \Exception();
            }

            $this->driverService->saveDriverConfig($driverVO);
            $response->setStatusCode(Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }
}