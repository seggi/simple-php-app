FROM php:8.0-apache

COPY ./ /var/www/html

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN apt-get update && apt-get upgrade -y
RUN docker-php-ext-install pdo_mysql

