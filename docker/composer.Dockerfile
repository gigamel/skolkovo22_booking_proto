FROM composer:latest

WORKDIR /var/www/skolkovo22_booking

ENTRYPOINT ["composer", "--ignore-platform-reqs"]
