<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

ini_set('memory_limit', '2GB');
/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201023145750 extends AbstractMigration
{
    private const FILE_LOCATION = __DIR__ . '/Addresses/Slask/queries.txt';

    public function getDescription() : string
    {
        return 'This migration is used to fill up addresses in slask voivodeship';
    }

    public function up(Schema $schema) : void
    {
        $file = fopen(self::FILE_LOCATION, 'r');

        while (! feof($file)) {
            $sql = fgets($file);
            var_dump($sql);
            if (is_string($sql)) {
                $this->addSql($sql);
            }
        }
    }

    public function down(Schema $schema) : void
    {
        $query = 'DELETE FROM `total_address`';
        $this->addSql($query);
    }
}
