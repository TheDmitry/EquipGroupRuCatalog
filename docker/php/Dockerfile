FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    nodejs \
    npm \
    && docker-php-ext-install pdo_mysql zip bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

RUN mkdir -p \
    storage \
    storage/framework \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/framework/testing \
    storage/framework/temp \
    bootstrap/cache \
    /tmp

RUN chmod -R 775 storage bootstrap/cache /tmp \
    && chown -R www-data:www-data storage bootstrap/cache

USER www-data

CMD ["php-fpm"]