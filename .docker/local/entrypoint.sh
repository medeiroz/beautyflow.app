#!/bin/sh

chmod 777 -R storage/
chmod 777 -R bootstrap/cache/

composer install
composer dump-autoload --optimize
composer clear-cache
php artisan optimize:clear
php artisan storage:link
php artisan migrate
php artisan ide-helper:generate
php artisan horizon:publish
#php artisan log-viewer:publish

if [ ! -d /.composer ]; then
    mkdir /.composer
fi

chmod -R ugo+rw /.composer


exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf

