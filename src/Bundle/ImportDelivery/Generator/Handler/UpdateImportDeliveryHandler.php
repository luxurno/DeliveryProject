<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Generator\Handler;

use App\Bundle\ImportDelivery\Entity\ImportDelivery;
use App\Bundle\ImportDelivery\Generator\Command\UpdateImportDeliveryCommand;
use Doctrine\ORM\EntityManagerInterface;

class UpdateImportDeliveryHandler
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function handle(UpdateImportDeliveryCommand $importDeliveryCommand): void
    {
        $importDeliveryDTO = $importDeliveryCommand->getImportDeliveryDTO();
        $coordinatesDTO = $importDeliveryCommand->getCoordinatesDTO();

        /** @var null|ImportDelivery $importDelivery */
        $importDelivery = $this->em->getRepository(ImportDelivery::class)
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
