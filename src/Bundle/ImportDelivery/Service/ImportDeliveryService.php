<?php

declare(strict_types = 1);

namespace App\Bundle\ImportDelivery\Service;

use App\Bundle\Import\Entity\Import;
use App\Bundle\Import\Factory\ImportFactory;
use App\Bundle\ImportDelivery\DTO\ImportDeliveryDTO;
use App\Bundle\ImportDelivery\Factory\ImportDeliveryDTOFactory;
use App\Bundle\ImportDelivery\Formatter\ImportDeliveryAddressFormatter;
use App\Bundle\ImportDelivery\Generator\ImportDeliveryGenerator;
use App\Bundle\ImportDelivery\Producer\ImportDeliveryProducer;
use App\Bundle\ImporterGenerator\Enum\ImportFileHeadersEnum;
use App\Bundle\User\Entity\User;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class ImportDeliveryService
{
    /** @var ImportDeliveryDTOFactory */
    private $importDeliveryDTOFactory;
    /** @var ImportDeliveryGenerator */
    private $importDeliveryGenerator;
    /** @var ImportDeliveryProducer */
    private $importDeliveryProducer;
    /** @var ImportFactory */
    private $importFactory;

    public function __construct(
        ImportDeliveryDTOFactory $importDeliveryDTOFactory,
        ImportDeliveryGenerator $importDeliveryGenerator,
        ImportDeliveryProducer $importDeliveryProducer,
        ImportFactory $importFactory
    )
    {
        $this->importDeliveryDTOFactory = $importDeliveryDTOFactory;
        $this->importDeliveryGenerator = $importDeliveryGenerator;
        $this->importDeliveryProducer = $importDeliveryProducer;
        $this->importFactory = $importFactory;
    }

    public function createImportDelivery(Import $import, array $importDelivery, int $index): void
    {
        $importDeliveryDTO = $this->importDeliveryDTOFactory->factory();

        $importDeliveryDTO->setCountry($importDelivery[ImportFileHeadersEnum::COUNTRY]);
        $importDeliveryDTO->setVoivodeship($importDelivery[ImportFileHeadersEnum::VOIVODESHIP]);
        $importDeliveryDTO->setDistrict($importDelivery[ImportFileHeadersEnum::DISTRICT]);
        $importDeliveryDTO->setCommunity($importDelivery[ImportFileHeadersEnum::COMMUNITY]);
        $importDeliveryDTO->setCity($importDelivery[ImportFileHeadersEnum::CITY]);
        $importDeliveryDTO->setStreet($importDelivery[ImportFileHeadersEnum::STREET]);
        $importDeliveryDTO->setNumber($importDelivery[ImportFileHeadersEnum::NUMBER]);
        $importDeliveryDTO->setPostalCode($importDelivery[ImportFileHeadersEnum::POSTAL_CODE]);
        $importDeliveryDTO->setCapacity((float) $importDelivery[ImportFileHeadersEnum::CAPACITY]);
        $importDeliveryDTO->setWeight((int) $importDelivery[ImportFileHeadersEnum::WEIGHT]);
        $importDeliveryDTO->setFormatted(ImportDeliveryAddressFormatter::format($importDeliveryDTO));

        $this->importDeliveryGenerator->create($import, $importDeliveryDTO);
        $this->importDeliveryProducer->addQueue($importDeliveryDTO, $index);
    }
}
