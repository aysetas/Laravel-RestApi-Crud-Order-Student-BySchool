#!/bin/sh
echo ""
echo "***********************************************************"
echo " Starting LARAVEL PHP-FPM Docker Container                 "
echo "***********************************************************"

set -e

#Check folder
pwd
chmod -R 775 /var/www/html/storage

## Check if the composer command exists
if [ -f /usr/local/bin/composer ]; then
    echo "Composer file found, installing dependencies..."
    # APP_ENV=prod composer update --no-dev --optimize-autoloader
    APP_ENV=prod composer install --optimize-autoloader
fi

## Check if the npm command exists
if [ -f /usr/bin/npm ]; then
    echo "Npm file found, building..."
    npm run build
fi

## Check if the supervisor config file exists
if [ -f /var/www/html/docker/prod/supervisor.conf ]; then
    echo "Supervisor config found, copying..."
    cp /var/www/html/docker/prod/supervisor.conf /etc/supervisor/conf.d/supervisor.conf
fi

## Check if php.ini file exists
if [ -f /var/www/html/docker/prod/php.ini ]; then
    cp /var/www/html/docker/prod/php.ini $PHP_INI_DIR/
    echo "Custom php.ini file found and copied in  $PHP_INI_DIR/"
fi

echo ""
echo "**********************************"
echo "     Starting Supervisord...     "
echo "***********************************"
supervisord -c /etc/supervisor/supervisord.conf

