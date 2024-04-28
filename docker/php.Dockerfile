FROM php:8.3-fpm-alpine

WORKDIR /var/www/skolkovo22_booking_proto

RUN docker-php-ext-install pdo pdo_mysql
