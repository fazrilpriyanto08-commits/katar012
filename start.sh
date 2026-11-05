#!/bin/bash
set -e

mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite
chown -R www-data:www-data /var/www/html/database /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/database /var/www/html/storage /var/www/html/bootstrap/cache

php artisan config:clear
php artisan migrate --force
php artisan db:seed --class=BusinessSeeder --force

apache2-foreground
