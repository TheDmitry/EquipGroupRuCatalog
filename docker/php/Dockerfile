FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl \
    && docker-php-ext-install pdo_mysql zip bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN mkdir -p storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache
RUN mkdir -p storage/framework/temp

WORKDIR /var/www/html