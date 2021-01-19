#!/bin/bash

# Migration DB
#php bin/console doctrine:database:drop --force
#php bin/console doctrine:database:create
#php bin/console doctrine:schema:update --force
#php bin/console doctrine:migration:migrate --no-interaction

# AI database dump
#php bin/console generate:train-db addressDb.csv
#php bin/console generate:train-db test_example4.csv 5 0
#php bin/console generate:train-db test_example5.csv 7 6
#php bin/console generate:train-db test_example6.csv 9 14

# Generate AI files
php bin/console import:generate warehousePackagesDb.csv 136 -i=true -o=true
php bin/console import:generate driverHistory_1.csv 1236 -i=true -o=true
php bin/console generate:from-resource driverHistory_1.csv warehousePackagesDb.csv -o=true

php bin/console import:generate test_example5.csv 10 -i=true -o=true
php bin/console import:generate test_example6.csv 12 -i=true -o=true
php bin/console import:generate test_example7.csv 13 -i=true -o=true
php bin/console import:generate test_example8.csv 8 -i=true -o=true
php bin/console import:generate test_example9.csv 15 -i=true -o=true
php bin/console generate:from-resource test_example5.csv warehousePackagesDb.csv -o=true
php bin/console generate:from-resource test_example6.csv warehousePackagesDb.csv -o=true
php bin/console generate:from-resource test_example7.csv warehousePackagesDb.csv -o=true
php bin/console generate:from-resource test_example8.csv warehousePackagesDb.csv -o=true
php bin/console generate:from-resource test_example9.csv warehousePackagesDb.csv -o=true
