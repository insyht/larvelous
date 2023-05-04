#!/bin/sh
cd /home/deb50767n5/public_html/iwscms
git pull -f
/home/deb50767n5/bin/composer install
php artisan migrate --force

