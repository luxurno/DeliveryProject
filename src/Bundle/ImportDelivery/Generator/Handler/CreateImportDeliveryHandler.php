<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Generator\Handler;

use App\Bundle\Import\Entity\Import;
use App\Bundle\ImportDelivery\DTO\ImportDeliveryDTO;
use App\Bundle\ImportDelivery\Factory\ImportDeliveryFactory;
use App\Bundle\ImportDelivery\Generator\Command\CreateImportDeliveryCommand;
use Doctrine\ORM\EntityManager;

class CreateImportDeliveryHandler
{
    /** @var EntityManager */
    private $em;
    /** @var ImportDeliveryFactory */
    private $importDeliveryFactory;

    public function __construct(
        EntityManager $em,
        ImportDeliveryFactory $importDeliveryFactory
    )
    {
        $this->em = $em;
        $this->importDeliveryFactory = $importDeliveryFactory;
    }

    public function handle(CreateImportDeliveryCommand $importDeliveryCommand): void
    {
        /** @var Import $import */
        $import = $importDeliveryCommand->getImport();
        /** @var ImportDeliveryDTO $importDeliveryDTO */
        $importDeliveryDTO = $importDeliveryCommand->getImportDeliveryDTO();

        $importDelivery = $this->importDeliveryFactory->factory();

        $importDelivery->setImport($import);

        $importDelivery->setKraj($importDeliveryDTO->getCountry());
        $importDelivery->setVoivodeship($importDeliveryDTO->getVoivodeship());
        $importDelivery->setPowiat($importDeliveryDTO->getDistrict());
        $importDelivery->setGmina($importDeliveryDTO->getCommunity());
        $importDelivery->setMiasto($importDeliveryDTO->getCity());
        $importDelivery->setUlica($importDeliveryDTO->getStreet());
        $importDelivery->setNumer($importDeliveryDTO->getNumber());
        $importDelivery->setKodPocztowy($importDeliveryDTO->getPostalCode());
        $importDelivery->updateTimestamps();

        $import->setImportDeliveries($importDelivery);

        $this->em->persist($import);
        $this->em->persist($importDelivery);
        $this->em->flush($importDelivery);
    }
}
