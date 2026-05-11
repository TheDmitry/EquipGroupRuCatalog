#!/bin/sh
set -e

php artisan config:clear
php artisan route:clear
php artisan view:clear

# Run the default command
exec "$@"