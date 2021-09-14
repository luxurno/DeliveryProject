<?php

namespace App\Tests\Unit\Bundle\Perception\Generator;

use App\Bundle\Perception\DTO\PerceptionDTO;
use App\Bundle\Perception\Factory\PerceptionDTOFactory;
use App\Bundle\Perception\Generator\PerceptionDTOGenerator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class PerceptionDTOGeneratorTest extends TestCase
{
    /** @var PerceptionDTO&MockObject */
    private $perceptionDTO;
    /** @var PerceptionDTOFactory&MockObject */
    private $perceptionDTOFactory;

    protected function setUp(): void
    {
        $this->perceptionDTO = $this->createMock(PerceptionDTO::class);
        $this->perceptionDTOFactory = $this->createMock(PerceptionDTOFactory::class);
    }

    public function testGenerate(): void
    {
        $this->perceptionDTOFactory->expects(self::once())
            ->method('factory')
            ->willReturn($this->perceptionDTO);

        $perceptionData = [
            'userId' => '123',
            'postal' => '41-340',
            'city' => 'Rudy',
            'street' => 'Rybnicka',
            'number' => null,
            'capacity' => '1m2',
            'weight' => '300kg',
        ];

        $this->perceptionDTO->expects(self::once())
            ->method('setUserId')
            ->with(123);
        $this->perceptionDTO->expects(self::once())
            ->method('setPostal')
            ->with('41-340');
        $this->perceptionDTO->expects(self::once())
            ->method('setCity')
            ->with('Rudy');
        $this->perceptionDTO->expects(self::once())
            ->method('setStreet')
            ->with('Rybnicka');
        $this->perceptionDTO->expects(self::once())
            ->method('setNumber')
            ->with('');
        $this->perceptionDTO->expects(self::once())
            ->method('setCapacity')
            ->with('1m2');
        $this->perceptionDTO->expects(self::once())
            ->method('setWeight')
            ->with('300kg');

        $perceptionDTOGenerator = new PerceptionDTOGenerator(
            $this->perceptionDTOFactory
        );
        $perceptionDTOGenerator->generate($perceptionData);
    }
}