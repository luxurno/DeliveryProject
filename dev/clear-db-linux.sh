#!/bin/bash

# Migration DB
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
php bin/console doctrine:migration:migrate --no-interaction

# AI database dump
### generate top-10 biggest cities
#php bin/console import:generate-city śląskie "Częstochowa.csv" "Częstochowa" -i=true -o=true
#php bin/console import:generate-city śląskie "Katowice.csv" "Katowice" -i=true -o=true
#php bin/console import:generate-city śląskie "Bielsko-Biała.csv" "Bielsko-Biała" -i=true -o=true
#php bin/console import:generate-city śląskie "Rybnik.csv" "Rybnik" -i=true -o=true
#php bin/console import:generate-city śląskie "Gliwice.csv" "Gliwice" -i=true -o=true
#php bin/console import:generate-city śląskie "Sosnowiec.csv" "Sosnowiec" -i=true -o=true
#php bin/console import:generate-city śląskie "Dąbrowa Górnicza.csv" "Dąbrowa Górnicza" -i=true -o=true
#php bin/console import:generate-city śląskie "Jaworzno.csv" "Jaworzno" -i=true -o=true
#php bin/console import:generate-city śląskie "Zabrze.csv" "Zabrze" -i=true -o=true
#php bin/console import:generate-city śląskie "Ruda Śląska.csv" "RUDA ŚLĄSKA" -i=true -o=true

# php bin/console import:generate warehousePackagesDb.csv 7360 -i=true -o=true
# php bin/console import:generate addressDb.csv 23600 -i=true -o=true
# php bin/console generate:from-resource addressDb.csv warehousePackagesDb.csv -o=true

# php bin/console import:generate test_example1.csv 10 -i=true -o=true
# php bin/console import:generate test_example2.csv 12 -i=true -o=true
# php bin/console import:generate test_example3.csv 13 -i=true -o=true
# php bin/console import:generate test_example4.csv 8 -i=true -o=true
# php bin/console import:generate test_example5.csv 15 -i=true -o=true
# php bin/console generate:from-resource test_example1.csv warehousePackagesDb.csv -o=true
# php bin/console generate:from-resource test_example2.csv warehousePackagesDb.csv -o=true
# php bin/console generate:from-resource test_example3.csv warehousePackagesDb.csv -o=true
# php bin/console generate:from-resource test_example4.csv warehousePackagesDb.csv -o=true
# php bin/console generate:from-resource test_example5.csv warehousePackagesDb.csv -o=true

# TODO adding model learning command
