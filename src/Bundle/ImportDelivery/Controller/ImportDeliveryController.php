<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImportDeliveryController extends AbstractController
{
    private const USER_ID = 1;

    /**
     * @Route("/api/import-delivery/save", name="import-delivery")
     * @param Request $request
     * @return Response
     */
    public function saveImport(Request $request): Response
    {
        $importData = json_decode($request->getContent(), true);
        var_dump($importData['data']);
        die;

        $response = new Response();


    }
}