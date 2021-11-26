### DeliveryProject for Engineering work

Notes: I've had to publicity this project, because my agreenment with BCMI

### Addresses in śląsk
http://www.gugik.gov.pl/pzgik/dane-bez-oplat/dane-z-panstwowego-rejestru-granic-i-powierzchni-jednostek-podzialow-terytorialnych-kraju-prg

### Unzip /\ Address files /\ into \/
resources/addresses/

### Run importer to prepare SQL with addresses inside container
cd src/Migrations/Addresses/Slask && php importer.php

### Run project
php -S localhost:8000 -t public
yarn encore dev --watch

## Connect to mysql via bash
docker-compose exec mysql mysql -u mysql -pdr3wGpoLbmuiJ2IyMhZH

### Step list:
- Build containers
- Run `composer install` and `npm install` inside container
- Run migrations inside app container `sh ./dev/clear-db-linux.sh` [`Check this file to uncomment doctrine setup`]
- Mostly use `predictionCity.py` and `warehouseModel.py`

### Requirements
- Finish `predictionCity.py` for specifics driver - I thought that prediction would return just `cityName`
- Don't quite remember what's needs to be finished on Front-end side
- Few things in PHP for sure
- Heuristics algorithm in PHP from predictionModel
- Remove examples from learning basics AI

### Run coordinates consumer
php bin/console import-delivery:coordinates-consumer 1
php bin/console perception:coordinates-consumer 1

### Example usage for AI
docker run -it --rm -v $PWD:/tmp -w /tmp tensorflow/tensorflow:latest python ./tensorflow/models/model.py

### Website from custom training
https://www.tensorflow.org/tutorials/customization/custom_training_walkthrough

### Custom text data sets in tensorflow
https://www.youtube.com/watch?v=NoKvCREx36Q

### Our docker image contains required dependencies
##### Run container
docker-compose exec tensorflow bash
##### Run training model
cd /var/www/models && python example.py

## Checking top-10 address cities for Sląsk
mysql> select COUNT(*) as `count`, `miasto` from total_address GROUP BY `miasto` ORDER BY `count` DESC LIMIT 10;
+-------+------------------+
| count | miasto           |
+-------+------------------+
| 32640 | Częstochowa      |
| 26699 | Katowice         |
| 26555 | Bielsko-Biała    |
| 22710 | Rybnik           |
| 19349 | Gliwice          |
| 16306 | Sosnowiec        |
| 15463 | Dąbrowa Górnicza |
| 14765 | Zabrze           |
| 14696 | Jaworzno         |
| 12552 | RUDA ŚLĄSKA      |
+-------+------------------+
10 rows in set (0.92 sec)
