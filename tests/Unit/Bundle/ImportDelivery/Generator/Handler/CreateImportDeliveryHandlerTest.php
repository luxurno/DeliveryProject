<?php

namespace App\Tests\Unit\Bundle\ImportDelivery\Generator\Handler;

use App\Bundle\Import\Entity\Import;
use App\Bundle\ImportDelivery\DTO\ImportDeliveryDTO;
use App\Bundle\ImportDelivery\Entity\ImportDelivery;
use App\Bundle\ImportDelivery\Factory\ImportDeliveryFactory;
use App\Bundle\ImportDelivery\Generator\Command\CreateImportDeliveryCommand;
use App\Bundle\ImportDelivery\Generator\Handler\CreateImportDeliveryHandler;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CreateImportDeliveryHandlerTest extends TestCase
{
    private const COUNTRY = 'Polska';
    private const VOIVODESHIP = 'Śląsk';
    private const DISTRICT = 'raciborski';
    private const COMMUNITY = 'Kuźnia Raciborska';
    private const CITY = 'Rudy';
    private const STREET = 'Rybnicka';
    private const NUMBER = '20';
    private const POSTAL_CODE = '47-430';

    /** @var EntityManager&MockObject */
    private $em;
    /** @var Import&MockObject */
    private $import;
    /** @var ImportDelivery&MockObject */
    private $importDelivery;
    /** @var ImportDeliveryDTO&MockObject */
    private $importDeliveryDTO;
    /** @var ImportDeliveryFactory&MockObject */
    private $importDeliveryFactory;

    protected function setUp(): void
    {
        $this->em = $this->createMock(EntityManager::class);
        $this->import = $this->createMock(Import::class);
        $this->importDelivery = $this->createMock(ImportDelivery::class);
        $this->importDeliveryDTO = $this->createMock(ImportDeliveryDTO::class);
        $this->importDeliveryFactory = $this->createMock(ImportDeliveryFactory::class);
    }

    public function testHandle(): void
    {
        $this->importDeliveryFactory->expects(self::once())
            ->method('factory')
            ->willReturn($this->importDelivery);

        $this->importDelivery->expects(self::once())
            ->method('setImport')
            ->with($this->import);

        $this->importDeliveryDTO->expects(self::once())
            ->method('getCountry')
            ->willReturn(self::COUNTRY);
        $this->importDeliveryDTO->expects(self::once())
            ->method('getVoivodeship')
            ->willReturn(self::VOIVODESHIP);
        $this->importDeliveryDTO->expects(self::once())
            ->method('getDistrict')
            ->willReturn(self::DISTRICT);
        $this->importDeliveryDTO->expects(self::once())
            ->method('getCommunity')
            ->willReturn(self::COMMUNITY);
        $this->importDeliveryDTO->expects(self::once())
            ->method('getCity')
            ->willReturn(self::CITY);
        $this->importDeliveryDTO->expects(self::once())
            ->method('getStreet')
            ->willReturn(self::STREET);
        $this->importDeliveryDTO->expects(self::once())
            ->method('getNumber')
            ->willReturn(self::NUMBER);
        $this->importDeliveryDTO->expects(self::once())
            ->method('getPostalCode')
            ->willReturn(self::POSTAL_CODE);

        $this->importDelivery->expects(self::once())
            ->method('setCountry')
            ->with(self::COUNTRY);
        $this->importDelivery->expects(self::once())
            ->method('setVoivodeship')
            ->with(self::VOIVODESHIP);
        $this->importDelivery->expects(self::once())
            ->method('setDistrict')
            ->with(self::DISTRICT);
        $this->importDelivery->expects(self::once())
            ->method('setCommunity')
            ->with(self::COMMUNITY);
        $this->importDelivery->expects(self::once())
            ->method('setCity')
            ->with(self::CITY);
        $this->importDelivery->expects(self::once())
            ->method('setStreet')
            ->with(self::STREET);
        $this->importDelivery->expects(self::once())
            ->method('setNumber')
            ->with(self::NUMBER);
        $this->importDelivery->expects(self::once())
            ->method('setPostalCode')
            ->with(...[self::POSTAL_CODE]);

        $this->importDelivery->expects(self::once())
            ->method('updateTimestamps');

        $this->import->expects(self::once())
            ->method('setImportDeliveries')
            ->with($this->importDelivery);

        $this->em->expects(self::atLeast(2))
            ->method('persist');
        $this->em->expects(self::once())
            ->method('flush');

        $createImportDeliveryHandler = new CreateImportDeliveryHandler(
            $this->em,
            $this->importDeliveryFactory
        );
        $createImportDeliveryHandler->handle(new CreateImportDeliveryCommand(
            $this->import,
            $this->importDeliveryDTO
        ));
    }
}
