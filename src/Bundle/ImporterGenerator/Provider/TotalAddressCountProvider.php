<?php

declare(strict_types = 1);

namespace App\Bundle\ImporterGenerator\Provider;

use App\Bundle\ImporterGenerator\Repository\TotalAddressRepository;

class TotalAddressCountProvider
{
    /** @var TotalAddressRepository */
    private $totalAddressRepository;

    public function __construct(TotalAddressRepository $totalAddressRepository)
    {
        $this->totalAddressRepository = $totalAddressRepository;
    }

    public function provideCountByVoivodeship(?string $voivodeship = null): int
    {
        return (int) $this->totalAddressRepository->createQueryBuilder('ta')
            ->select('count(ta.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
