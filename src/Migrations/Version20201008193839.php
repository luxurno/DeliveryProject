<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201008193839 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'This migration is used to set first user into panel';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO `user` SET 
                                `type`='spedytor', 
                                `nick`='Luxurno Marcin Szostak', 
                                `email`='luxurno@luxurno.com',
                                `first_name`='Marcin',
                                `last_name`='Szostak',
                                `created_at`=NOW()
                                ");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("DELETE FROM `user` WHERE `nick`='Luxurno Marcin Szostak' LIMIT 1");
    }
}
