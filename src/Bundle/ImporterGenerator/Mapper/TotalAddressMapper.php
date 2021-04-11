<?php

declare(strict_types=1);

namespace App\Bundle\ImporterGenerator\Mapper;

use App\Bundle\ImporterGenerator\Entity\TotalAddress;
use App\Bundle\ImporterGenerator\Enum\ImportFileHeadersEnum;

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
                ImportFileHeadersEnum::COUNTRY => $totalAddress->getKraj(),
                ImportFileHeadersEnum::DISTRICT => $totalAddress->getPowiat(),
                ImportFileHeadersEnum::COMMUNITY => $totalAddress->getGmina(),
                ImportFileHeadersEnum::CITY => $totalAddress->getMiasto(),
                ImportFileHeadersEnum::STREET => $totalAddress->getUlica(),
                ImportFileHeadersEnum::NUMBER => $totalAddress->getNumer(),
                ImportFileHeadersEnum::POSTAL_CODE => $totalAddress->getKodPocztowy(),
                ImportFileHeadersEnum::HASH => $totalAddress->getHash(),
            ];
        }

        return [
            ImportFileHeadersEnum::COUNTRY => $totalAddress->getKraj(),
            ImportFileHeadersEnum::DISTRICT => $totalAddress->getPowiat(),
            ImportFileHeadersEnum::COMMUNITY => $totalAddress->getGmina(),
            ImportFileHeadersEnum::CITY => $totalAddress->getMiasto(),
            ImportFileHeadersEnum::STREET => $totalAddress->getUlica(),
            ImportFileHeadersEnum::NUMBER => $totalAddress->getNumer(),
            ImportFileHeadersEnum::POSTAL_CODE => $totalAddress->getKodPocztowy(),
        ];
    }
}
