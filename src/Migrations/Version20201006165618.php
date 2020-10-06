<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201006165618 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Migration to create table for all addresses';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE `total_address` (
                    `id` INT(11) NOT NULL AUTO_INCREMENT,
                    `create_date` DATETIME NULL DEFAULT NULL,
                    `kraj` VARCHAR(255) NULL DEFAULT NULL COLLATE \'utf8_polish_ci\',
                    `powiat` VARCHAR(255) NULL DEFAULT NULL COLLATE \'utf8_polish_ci\',
                    `gmina` VARCHAR(255) NULL DEFAULT NULL COLLATE \'utf8_polish_ci\',
                    `miasto` VARCHAR(255) NULL DEFAULT NULL COLLATE \'utf8_polish_ci\',
                    `ulica` VARCHAR(255) NULL DEFAULT NULL COLLATE \'utf8_polish_ci\',
                    `numer` VARCHAR(255) NULL DEFAULT NULL COLLATE \'utf8_polish_ci\',
                    `kod_pocztowy` VARCHAR(255) NULL DEFAULT NULL COLLATE \'utf8_polish_ci\',
                    `hash` VARCHAR(255) NULL DEFAULT NULL COLLATE \'utf8_polish_ci\',
                    `change_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (`id`),
                    UNIQUE INDEX `hash` (`hash`)
                )
                COLLATE=\'utf8_polish_ci\'
                ENGINE=InnoDB
                AUTO_INCREMENT=780892;');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE `total_address`');
    }
}
