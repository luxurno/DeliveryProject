<?php

namespace App\Tests\Unit\Bundle\ImportDelivery\Generator\Handler;

use App\Bundle\ImportDelivery\DTO\ImportDeliveryDTO;
use App\Bundle\ImportDelivery\Entity\ImportDelivery;
use App\Bundle\ImportDelivery\Generator\Command\UpdateImportDeliveryCommand;
use App\Bundle\ImportDelivery\Generator\Handler\UpdateImportDeliveryHandler;
use App\Bundle\ImportDelivery\Repository\ImportDeliveryRepository;
use App\Core\Coordinates\DTO\CoordinatesDTO;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UpdateImportDeliveryHandlerTest extends TestCase
{
    private const LATITUDE = '38.8951';
    private const LONGITUDE = '-77.0364';

    /** @var EntityManager&MockObject */
    private $em;
    /** @var CoordinatesDTO&MockObject */
    private $coordinatesDTO;
    /** @var ImportDelivery&MockObject */
    private $importDelivery;
    /** @var ImportDeliveryDTO&MockObject */
    private $importDeliveryDTO;

    protected function setUp(): void
    {
        $this->em = $this->createMock(EntityManager::class);
        $this->coordinatesDTO = $this->createMock(CoordinatesDTO::class);
        $this->importDelivery = $this->createMock(ImportDelivery::class);
        $this->importDeliveryDTO = $this->createMock(ImportDeliveryDTO::class);
    }

    public function testHandle(): void
    {
        $repository = $this->createMock(ImportDeliveryRepository::class);

        $this->em->expects(self::once())
            ->method('getRepository')
            ->willReturn($repository);

        $repository->expects(self::once())
            ->method('findOneBy')
            ->willReturn($this->importDelivery);

        $this->coordinatesDTO->expects(self::once())
            ->method('getLatitude')
            ->willReturn(self::LATITUDE);
        $this->coordinatesDTO->expects(self::once())
            ->method('getLongitude')
            ->willReturn(self::LONGITUDE);

        $this->importDelivery->expects(self::once())
            ->method('setLat')
            ->with(self::LATITUDE);
        $this->importDelivery->expects(self::once())
            ->method('setLng')
            ->with(self::LONGITUDE);
        $this->importDelivery->expects(self::once())
            ->method('updateTimestamps');

        $this->em->expects(self::once())
            ->method('persist')
            ->with($this->importDelivery);
        $this->em->expects(self::once())
            ->method('flush');

        $updateImportDeliveryHandler = new UpdateImportDeliveryHandler(
            $this->em
        );
        $updateImportDeliveryHandler->handle(new UpdateImportDeliveryCommand(
            $this->importDeliveryDTO,
            $this->coordinatesDTO
        ));
    }
}