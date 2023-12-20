# Dockerfile for Laravel 10 with PHP 8.2
# Maintainer: [name] <[email]>

# Use an official PHP runtime as a parent image
FROM php:8.2-fpm-bullseye

# Set environment variables
ENV APP_HOME /var/www/html
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV TZ=UTC
ENV DOCUMENT_ROOT=${APP_HOME}
ENV LARAVEL_PROCS_NUMBER=1
ARG WWWGROUP=1000
ARG NODE_VERSION=18.x
ARG HOST_UID=1000
ENV USER=www-data

RUN echo "UTC" > /etc/timezone

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmemcached-dev \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    librdkafka-dev \
    libpq-dev \
    openssh-server \
    zip \
    unzip \
    supervisor \
    sqlite3  \
    nano \
    cron \
    nginx
 \
    # Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions zip, mbstring, exif, bcmath, intl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install  zip mbstring exif pcntl bcmath -j$(nproc) gd intl

# Install the PHP pdo_mysql extention
RUN docker-php-ext-install pdo_mysql

RUN curl -fsSL https://deb.nodesource.com/setup_${NODE_VERSION} | bash -
 # Install Node
RUN apt-get install -y nodejs

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configure supervisor
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

COPY entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh
RUN ln -s /usr/local/bin/entrypoint.sh /

ENTRYPOINT ["entrypoint.sh"]

# Create the application directory and make it the working directory
RUN rm -Rf /var/www/* && \
mkdir -p $APP_HOME
WORKDIR $APP_HOME

RUN usermod -u ${HOST_UID} www-data
RUN groupmod -g ${HOST_UID} www-data

RUN chmod -R 755 $APP_HOME
RUN chown -R www-data:www-data $APP_HOME

# Expose port and start server
EXPOSE 9000
# CMD ["entrypoint.sh"]
