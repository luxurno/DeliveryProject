<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Generator\Handler;

use App\Bundle\ImportDelivery\Entity\ImportDelivery;
use App\Bundle\ImportDelivery\Generator\Command\UpdateImportDeliveryCommand;
use App\Bundle\ImportDelivery\Repository\ImportDeliveryRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateImportDeliveryHandler
{
    /** @var EntityManagerInterface */
    private $em;
    /** @var ImportDeliveryRepository */
    private $importDeliveryRepository;

    public function __construct(
        EntityManagerInterface $em,
        ImportDeliveryRepository $importDeliveryRepository
    )
    {
        $this->em = $em;
        $this->importDeliveryRepository = $importDeliveryRepository;
    }

    public function handle(UpdateImportDeliveryCommand $importDeliveryCommand): void
    {
        $importDeliveryDTO = $importDeliveryCommand->getImportDeliveryDTO();
        $coordinatesDTO = $importDeliveryCommand->getCoordinatesDTO();

        /** @var null|ImportDelivery $importDelivery */
        $importDelivery = $this->importDeliveryRepository
            ->findOneBy(['formatted' => $importDeliveryDTO->getFormatted()]);

        if ($importDelivery !== null) {
            $importDelivery->setLat($coordinatesDTO->getLatitude());
            $importDelivery->setLng($coordinatesDTO->getLongitude());
            $importDelivery->updateTimestamps();

            $this->em->persist($importDelivery);
            $this->em->flush();
        }
    }
}
