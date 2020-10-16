FROM php:7.2

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN alias composer="php -n /usr/local/bin/composer"

ARG PROJECT_ROOT="/var/www"
ENV PROJECT_ROOT=${PROJECT_ROOT}

# Install dependencies
RUN apt-get update && apt-get install -y vim
RUN apt-get install -y \
      zlib1g-dev \
      libzip-dev \
      unzip
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR ${PROJECT_ROOT}

COPY ./ ${PROJECT_ROOT}

RUN composer install --prefer-dist --no-interaction
RUN composer dump-autoload --optimize --quiet

