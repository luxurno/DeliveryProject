<?php

declare(strict_types = 1);

namespace App\Bundle\Import\Factory;

use App\Bundle\Import\Entity\Import;

class ImportFactory implements ImportFactoryInterface
{
    public function factory(): Import
    {
        return new Import();
    }
}
