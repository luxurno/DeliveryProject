<?php

namespace App\Tests\Unit\Bundle\ImportGenerator\Mapper;

use App\Bundle\ImporterGenerator\Entity\TotalAddress;
use App\Bundle\ImporterGenerator\Enum\ImportFileHeadersEnum;
use App\Bundle\ImporterGenerator\Mapper\TotalAddressMapper;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TotalAddressMapperTest extends TestCase
{
    private const ID = 234;
    private const COUNTRY = 'Polska';
    private const DISTRICT = 'raciborski';
    private const COMMUNITY = 'Kuźnia Raciborska';
    private const CITY = 'Rudy';
    private const NUMBER = '20';
    private const STREET = 'Rybnicka';
    private const POSTAL_CODE = '47-430';
    private const HASH = 'a5cc5f59cfa00dee4cbeb378db7fc12314524494';

    /** @var TotalAddress&MockObject */
    private $totalAddress;

    public function setUp(): void
    {
        $this->totalAddress = $this->createMock(TotalAddress::class);

        $this->totalAddress->method('getId')
            ->willReturn(self::ID);
        $this->totalAddress->expects(self::once())
            ->method('getCountry')
            ->willReturn(self::COUNTRY);
        $this->totalAddress->expects(self::once())
            ->method('getDistrict')
            ->willReturn(self::DISTRICT);
        $this->totalAddress->expects(self::once())
            ->method('getCommunity')
            ->willReturn(self::COMMUNITY);
        $this->totalAddress->expects(self::once())
            ->method('getCity')
            ->willReturn(self::CITY);
        $this->totalAddress->expects(self::once())
            ->method('getStreet')
            ->willReturn(self::STREET);
        $this->totalAddress->expects(self::once())
            ->method('getNumber')
            ->willReturn(self::NUMBER);
        $this->totalAddress->expects(self::once())
            ->method('getPostalCode')
            ->willReturn(self::POSTAL_CODE);
        $this->totalAddress->method('getHash')
            ->willReturn(self::HASH);
    }

    public function testMapperWithInclude(): void
    {
        $totalAddressMapper = new TotalAddressMapper();

        self::assertEquals(
            [

                ImportFileHeadersEnum::ID => self::ID,
                ImportFileHeadersEnum::COUNTRY => self::COUNTRY,
                ImportFileHeadersEnum::DISTRICT => self::DISTRICT,
                ImportFileHeadersEnum::COMMUNITY => self::COMMUNITY,
                ImportFileHeadersEnum::CITY => self::CITY,
                ImportFileHeadersEnum::STREET => self::STREET,
                ImportFileHeadersEnum::NUMBER => self::NUMBER,
                ImportFileHeadersEnum::POSTAL_CODE => '47430',
                ImportFileHeadersEnum::HASH => self::HASH,
            ],
            $totalAddressMapper->map(true, $this->totalAddress)
        );
    }

    public function testMapperWithoutInclude(): void
    {
        $totalAddressMapper = new TotalAddressMapper();

        self::assertEquals(
            [
                ImportFileHeadersEnum::COUNTRY => self::COUNTRY,
                ImportFileHeadersEnum::DISTRICT => self::DISTRICT,
                ImportFileHeadersEnum::COMMUNITY => self::COMMUNITY,
                ImportFileHeadersEnum::CITY => self::CITY,
                ImportFileHeadersEnum::STREET => self::STREET,
                ImportFileHeadersEnum::NUMBER => self::NUMBER,
                ImportFileHeadersEnum::POSTAL_CODE => '47430',
            ],
            $totalAddressMapper->map(false, $this->totalAddress)
        );
    }
}