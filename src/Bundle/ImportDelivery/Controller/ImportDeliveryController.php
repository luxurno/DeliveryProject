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

        var_dump('saves');
        die;

        $response = new Response();


    }
}