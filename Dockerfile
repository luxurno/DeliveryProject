FROM php:7.2-fpm

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
RUN docker-php-ext-install pdo pdo_mysql sockets
RUN docker-php-ext-enable sockets

# Install Yarn
RUN apt install gnupg -y
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
RUN apt update && apt install yarn -y

WORKDIR ${PROJECT_ROOT}

COPY ./ ${PROJECT_ROOT}

#RUN composer install --prefer-dist --no-interaction
#RUN composer dump-autoload --optimize --quiet
