<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Controller;

use App\Bundle\ImportDelivery\Exception\MissingResultsException;
use App\Bundle\ImportDelivery\Resolver\ImportDeliveryResolver;
use App\Bundle\User\Exception\UserNotFound;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class ImportDeliveryController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $em;
    /** @var ImportDeliveryResolver */
    private $importDeliveryResolver;

    public function __construct(
        EntityManagerInterface $em,
        ImportDeliveryResolver $importDeliveryResolver
    )
    {
        $this->em = $em;
        $this->importDeliveryResolver = $importDeliveryResolver;
    }

    /**
     * @Route("/api/import-delivery/save", name="import-delivery")
     * @param Request $request
     * @return Response
     * @throws MissingResultsException
     */
    public function saveImport(Request $request): Response
    {
        $importData = json_decode($request->getContent(), true);

        if ($importData['data'] === []) {
            throw new MissingResultsException('Empty results');
        }

        $response = new Response();
        try {
            $this->importDeliveryResolver->resolve($importData);
            $response->setStatusCode(Response::HTTP_NO_CONTENT);
        } catch (UserNotFound $e) {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        } catch (Throwable $e) {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
    }
}