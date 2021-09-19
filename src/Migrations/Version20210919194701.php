<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210919194701 extends AbstractMigration
{
    private const FILE_LOCATION = __DIR__ . '/ImportDelivery/import_delivery.csv';

    public function getDescription() : string
    {
        return 'This migration is used to automatic import generation to not waste Google queries';
    }

    public function up(Schema $schema) : void
    {
        $file = fopen(self::FILE_LOCATION, 'r');

        $first = true;
        $headers = [];
        while (! feof($file)) {
            $row = fgetcsv($file);

            if (false === $first) {
                $query = "INSERT INTO `import_delivery` SET ";
                $insert = true;
                foreach ($headers as $key => $header) {
                    $rowData = $row[$key];

                    if ('id' === $header) {
                        if ('' === $rowData) {
                            $insert = false;
                        }
                    }

                    if ('route_id' === $header) {
                        $query .= "`".$header."`= NULL, ";
                    } else {
                        $query .= "`".$header."`= '".$rowData."', ";
                    }
                }
                $query = substr($query, 0, -2);

                if ($insert) {
                    $this->addSql($query);
                }
                var_dump($query);
            }

            if ($first) {
                $headers = $row;
                $first = false;
            }
        }
    }

    public function down(Schema $schema) : void
    {
        $query = 'DELETE FROM `route`';
        $this->addSql($query);
        $query = 'DELETE FROM `import_delivery`';
        $this->addSql($query);
    }
}
