FROM nginx:stable-bullseye

ARG WORKDIR=/var/www/html
ENV DOCUMENT_ROOT=${WORKDIR}/public
ENV PHP_FPM_HOST=php-fpm:9000

COPY nginx-laravel.conf /etc/nginx/conf.d/default.conf
