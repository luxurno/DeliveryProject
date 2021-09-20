<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Bundle\NearBy\Service\NearByService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class NearByController extends AbstractController
{
    /** @var NearByService */
    private $nearByService;

    public function __construct(NearByService $nearByService)
    {
        $this->nearByService = $nearByService;
    }

    /**
     * @Route("/api/near-by", name="near-by")
     * @return Response
     */
    public function getNearBy(Request $request): Response
    {
        $userId = $request->get('userId', null);
        $perceptionId = $request->get('perceptionId', null);

        $response = new Response();
        try {
            if (false === is_numeric($userId)) {
                throw new \Exception();
            }
            if (false === is_numeric($perceptionId)) {
                throw new \Exception();
            }

            $nearBy = $this->nearByService->getNearBy((int) $userId, (int) $perceptionId);
            $response->headers->set('Content-Type', 'application/json');
            $response->setContent(json_encode($nearBy));
            $response->setStatusCode(Response::HTTP_OK);
        } catch (NotFoundHttpException $e) {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }
//        catch (\Throwable $e) {
//            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
//        }

        return $response;
    }
}
