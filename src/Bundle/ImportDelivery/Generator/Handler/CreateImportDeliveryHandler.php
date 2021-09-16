<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Generator\Handler;

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
        $import = $importDeliveryCommand->getImport();
        $importDeliveryDTO = $importDeliveryCommand->getImportDeliveryDTO();

        $importDelivery = $this->importDeliveryFactory->factory();

        $importDelivery->setImport($import);

        $importDelivery->setCountry($importDeliveryDTO->getCountry());
        $importDelivery->setVoivodeship($importDeliveryDTO->getVoivodeship());
        $importDelivery->setDistrict($importDeliveryDTO->getDistrict());
        $importDelivery->setCommunity($importDeliveryDTO->getCommunity());
        $importDelivery->setCity($importDeliveryDTO->getCity());
        $importDelivery->setStreet($importDeliveryDTO->getStreet());
        $importDelivery->setNumber($importDeliveryDTO->getNumber());
        $importDelivery->setPostalCode($importDeliveryDTO->getPostalCode());
        $importDelivery->setCapacity($importDeliveryDTO->getCapacity());
        $importDelivery->setWeight($importDeliveryDTO->getWeight());
        $importDelivery->setFormatted($importDeliveryDTO->getFormatted());
        $importDelivery->updateTimestamps();

        $import->setImportDeliveries($importDelivery);

        $this->em->persist($import);
        $this->em->persist($importDelivery);
        $this->em->flush($importDelivery);
    }
}
