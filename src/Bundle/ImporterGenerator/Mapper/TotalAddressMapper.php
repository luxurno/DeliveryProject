<?php

declare(strict_types=1);

namespace App\Bundle\ImporterGenerator\Mapper;

use App\Bundle\ImporterGenerator\Entity\TotalAddress;
use App\Bundle\ImporterGenerator\Enum\ImportFileHeadersEnum;
use App\Core\Filter\PostalCodeConverter;

class TotalAddressMapper
{
    public function map(
        bool $includeReq,
        TotalAddress $totalAddress
    ): array
    {
        if ($includeReq) {
            return [
                ImportFileHeadersEnum::ID => $totalAddress->getId(),
                ImportFileHeadersEnum::COUNTRY => $totalAddress->getCountry(),
                ImportFileHeadersEnum::DISTRICT => $totalAddress->getDistrict(),
                ImportFileHeadersEnum::COMMUNITY => $totalAddress->getCommunity(),
                ImportFileHeadersEnum::CITY => $totalAddress->getCity(),
                ImportFileHeadersEnum::STREET => $totalAddress->getStreet(),
                ImportFileHeadersEnum::NUMBER => $totalAddress->getNumber(),
                ImportFileHeadersEnum::POSTAL_CODE => PostalCodeConverter::filter(
                    $totalAddress->getPostalCode()
                ),
                ImportFileHeadersEnum::HASH => $totalAddress->getHash(),
            ];
        }

        return [
            ImportFileHeadersEnum::COUNTRY => $totalAddress->getCountry(),
            ImportFileHeadersEnum::DISTRICT => $totalAddress->getDistrict(),
            ImportFileHeadersEnum::COMMUNITY => $totalAddress->getCommunity(),
            ImportFileHeadersEnum::CITY => $totalAddress->getCity(),
            ImportFileHeadersEnum::STREET => $totalAddress->getStreet(),
            ImportFileHeadersEnum::NUMBER => $totalAddress->getNumber(),
            ImportFileHeadersEnum::POSTAL_CODE => PostalCodeConverter::filter(
                $totalAddress->getPostalCode()
            ),
        ];
    }
}
