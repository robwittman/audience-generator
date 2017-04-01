FROM php:7.0-apache

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libfreetype6-dev \
    libmcrypt-dev \
    libpq-dev \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo pdo_pgsql \
    && docker-php-ext-install bcmath
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY . /var/www
WORKDIR /var/www
RUN composer install
RUN a2enmod rewrite
