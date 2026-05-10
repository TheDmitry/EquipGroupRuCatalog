#!/bin/sh

composer install

npm install

php artisan key:generate --force

php artisan migrate --force

npm run build

php-fpm