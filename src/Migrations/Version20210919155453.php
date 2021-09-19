<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210919155453 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'This migration is used to generate top10 cities in śląskie voivodeship';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO `top_city` SET `country`='Poland', `voivodeship`='śląskie', `city`='Częstochowa', `lat`='50.8118195000000000', `lng`='19.1203094000000000', `created_at`=NOW()");
        $this->addSql("INSERT INTO `top_city` SET `country`='Poland', `voivodeship`='śląskie', `city`='Katowice', `lat`='50.2648919000000000', `lng`='19.0237815000000000', `created_at`=NOW()");
        $this->addSql("INSERT INTO `top_city` SET `country`='Poland', `voivodeship`='śląskie', `city`='Bielsko-Biała', `lat`='49.8223768000000000', `lng`='19.0583845000000000', `created_at`=NOW()");
        $this->addSql("INSERT INTO `top_city` SET `country`='Poland', `voivodeship`='śląskie', `city`='Rybnik', `lat`='50.1021742000000000', `lng`='18.5462847000000000', `created_at`=NOW()");
        $this->addSql("INSERT INTO `top_city` SET `country`='Poland', `voivodeship`='śląskie', `city`='Gliwice', `lat`='50.2944923000000000', `lng`='18.6713802000000000', `created_at`=NOW()");
        $this->addSql("INSERT INTO `top_city` SET `country`='Poland', `voivodeship`='śląskie', `city`='Sosnowiec', `lat`='50.2862638000000000', `lng`='19.1040791000000000', `created_at`=NOW()");
        $this->addSql("INSERT INTO `top_city` SET `country`='Poland', `voivodeship`='śląskie', `city`='Dąbrowa Górnicza', `lat`='50.3216897000000000', `lng`='19.1949126000000000', `created_at`=NOW()");
        $this->addSql("INSERT INTO `top_city` SET `country`='Poland', `voivodeship`='śląskie', `city`='Jaworzno', `lat`='50.2049870000000000', `lng`='19.2739314000000000', `created_at`=NOW()");
        $this->addSql("INSERT INTO `top_city` SET `country`='Poland', `voivodeship`='śląskie', `city`='Zabrze', `lat`='50.3249278000000000', `lng`='18.7857186000000000', `created_at`=NOW()");
        $this->addSql("INSERT INTO `top_city` SET `country`='Poland', `voivodeship`='śląskie', `city`='Ruda Śląska', `lat`='50.2558286000000000', `lng`='18.8555704000000000', `created_at`=NOW()");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("DELETE FROM `top_city` WHERE `city`='Częstochowa' LIMIT 1");
        $this->addSql("DELETE FROM `top_city` WHERE `city`='Katowice' LIMIT 1");
        $this->addSql("DELETE FROM `top_city` WHERE `city`='Bielsko-Biała' LIMIT 1");
        $this->addSql("DELETE FROM `top_city` WHERE `city`='Rybnik' LIMIT 1");
        $this->addSql("DELETE FROM `top_city` WHERE `city`='Gliwice' LIMIT 1");
        $this->addSql("DELETE FROM `top_city` WHERE `city`='Sosnowiec' LIMIT 1");
        $this->addSql("DELETE FROM `top_city` WHERE `city`='Dąbrowa Górnicza' LIMIT 1");
        $this->addSql("DELETE FROM `top_city` WHERE `city`='Jaworzno' LIMIT 1");
        $this->addSql("DELETE FROM `top_city` WHERE `city`='Zabrze' LIMIT 1");
        $this->addSql("DELETE FROM `top_city` WHERE `city`='Ruda Śląska' LIMIT 1");
    }
}
