<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201020062056 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Adding drivers';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO `driver` SET `user_id`='1', `name`='Andrzej Kowalski', `image`='https://randomuser.me/api/portraits/men/42.jpg'");
        $this->addSql("INSERT INTO `driver` SET `user_id`='1', `name`='Karol Kowalski', `image`='https://randomuser.me/api/portraits/men/43.jpg'");
        $this->addSql("INSERT INTO `driver` SET `user_id`='1', `name`='Czarek Szpak', `image`='https://randomuser.me/api/portraits/men/53.jpg'");
        $this->addSql("INSERT INTO `driver` SET `user_id`='1', `name`='Marek Kuzior', `image`='https://randomuser.me/api/portraits/men/25.jpg'");
        $this->addSql("INSERT INTO `driver` SET `user_id`='1', `name`='Jan Kozak', `image`='https://randomuser.me/api/portraits/men/35.jpg'");
        $this->addSql("INSERT INTO `driver` SET `user_id`='1', `name`='Konstanty Sokołowski', `image`='https://randomuser.me/api/portraits/men/74.jpg'");
        $this->addSql("INSERT INTO `driver` SET `user_id`='1', `name`='Ireneusz Krajewska', `image`='https://randomuser.me/api/portraits/men/41.jpg'");
        $this->addSql("INSERT INTO `driver` SET `user_id`='1', `name`='Konstanty Czerwiński', `image`='https://randomuser.me/api/portraits/men/38.jpg'");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("DELETE FROM `driver` WHERE `name`='Andrzej Kowalski' LIMIT 1");
        $this->addSql("DELETE FROM `driver` WHERE `name`='Karol Kowalski' LIMIT 1");
        $this->addSql("DELETE FROM `driver` WHERE `name`='Czarek Szpak' LIMIT 1");
        $this->addSql("DELETE FROM `driver` WHERE `name`='Marek Kuzior' LIMIT 1");
        $this->addSql("DELETE FROM `driver` WHERE `name`='Jan Kozak' LIMIT 1");
        $this->addSql("DELETE FROM `driver` WHERE `name`='Konstanty Sokołowski' LIMIT 1");
        $this->addSql("DELETE FROM `driver` WHERE `name`='Ireneusz Krajewska' LIMIT 1");
        $this->addSql("DELETE FROM `driver` WHERE `name`='Konstanty Czerwiński' LIMIT 1");
    }
}
