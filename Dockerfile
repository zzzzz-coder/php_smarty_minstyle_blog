FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY . /var/www/html/

RUN mkdir -p /var/www/html/tmp/templates_c \
    && mkdir -p /var/www/html/tmp/cache \
    && chmod -R 777 /var/www/html/tmp