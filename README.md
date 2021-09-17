### Addresses in śląsk
http://www.gugik.gov.pl/pzgik/dane-bez-oplat/dane-z-panstwowego-rejestru-granic-i-powierzchni-jednostek-podzialow-terytorialnych-kraju-prg

### Run project
php -S localhost:8000 -t public
yarn encore dev --watch

### Run coordinates consumer
php bin/console import-delivery:coordinates-consumer 1

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
