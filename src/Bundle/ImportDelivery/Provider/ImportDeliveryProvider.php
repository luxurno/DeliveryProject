<?php

declare(strict_types=1);

namespace App\Bundle\ImportDelivery\Provider;

use App\Bundle\ImportDelivery\Repository\ImportDeliveryRepository;

class ImportDeliveryProvider
{
    /** @var ImportDeliveryRepository */
    private $importDeliveryRepository;

    public function __construct(ImportDeliveryRepository $importDeliveryRepository)
    {
        $this->importDeliveryRepository = $importDeliveryRepository;
    }

    public function provideNearByLatAndLng(
        int $importId,
        string $latitude,
        string $longitude
    ): array
    {
        return $this->importDeliveryRepository->provideNearByLatAndLng(
            $importId,
            $latitude,
            $longitude
        );
    }

    public function provideNearByLatAndLngWithRoutes(
        int $importId,
        string $latitude,
        string $longitude
    ): array
    {
        return $this->importDeliveryRepository->provideNearByLatAndLngWithRoutes(
            $importId,
            $latitude,
            $longitude
        );
    }
}
