#!/bin/bash

php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
php bin/console doctrine:migration:migrate --no-interaction

# AI database dump
php bin/console generate:train-db addressDb.csv
php bin/console generate:train-db test_example4.csv 5 0
php bin/console generate:train-db test_example5.csv 7 6
php bin/console generate:train-db test_example6.csv 9 14
