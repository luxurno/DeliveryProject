#!/bin/bash

# Migration DB
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
php bin/console doctrine:migration:migrate --no-interaction

# AI database dump

### Generate cities
#php bin/console generate:train-db Częstochowa.csv --city="Częstochowa"
#php bin/console generate:train-db Katowice.csv --city="Katowice"
#php bin/console generate:train-db Bielsko-Biała.csv --city="Bielsko-Biała"
#php bin/console generate:train-db Rybnik.csv --city="Rybnik"
#php bin/console generate:train-db Gliwice.csv --city="Gliwice"
#php bin/console generate:train-db Sosnowiec.csv --city="Sosnowiec"
#php bin/console generate:train-db "Dąbrowa Górnicza.csv" --city="Dąbrowa Górnicza"
#php bin/console generate:train-db Jaworzno.csv --city="Jaworzno"
#php bin/console generate:train-db Zabrze.csv --city="Zabrze"
#php bin/console generate:train-db "Ruda Śląska.csv" --city="RUDA ŚLĄSKA"
#php bin/console generate:train-db addressDb.csv
#php bin/console generate:train-db test_example4.csv 5 0
#php bin/console generate:train-db test_example5.csv 7 6
#php bin/console generate:train-db test_example6.csv 9 14

# Generate AI files
#php bin/console import:generate warehousePackagesDb.csv 7360 -i=true -o=true
#php bin/console import:generate driverHistory_1.csv 23600 -i=true -o=true
#php bin/console generate:from-resource driverHistory_1.csv warehousePackagesDb.csv -o=true

#php bin/console import:generate test_example5.csv 10 -i=true -o=true
#php bin/console import:generate test_example6.csv 12 -i=true -o=true
#php bin/console import:generate test_example7.csv 13 -i=true -o=true
#php bin/console import:generate test_example8.csv 8 -i=true -o=true
#php bin/console import:generate test_example9.csv 15 -i=true -o=true
#php bin/console generate:from-resource test_example5.csv warehousePackagesDb.csv -o=true
#php bin/console generate:from-resource test_example6.csv warehousePackagesDb.csv -o=true
#php bin/console generate:from-resource test_example7.csv warehousePackagesDb.csv -o=true
#php bin/console generate:from-resource test_example8.csv warehousePackagesDb.csv -o=true
#php bin/console generate:from-resource test_example9.csv warehousePackagesDb.csv -o=true
