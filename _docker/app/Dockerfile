FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
      apt-utils \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      zip unzip \
      git && \
      docker-php-ext-install -j$(nproc) pdo_pgsql bcmath gd zip && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*


WORKDIR /var/www/html

COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini
COPY . /var/www/html