FROM composer:latest

WORKDIR /var/www/skolkovo22_booking_proto

ENTRYPOINT ["composer", "--ignore-platform-reqs"]
