#!/bin/sh

php artisan migrate;
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf;
