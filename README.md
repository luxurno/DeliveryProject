### Run project
php -S localhost:8000 -t public
yarn encore dev --watch

### Example usage for AI
docker run -it --rm -v $PWD:/tmp -w /tmp tensorflow/tensorflow:latest python ./tensorflow/models/model.py
