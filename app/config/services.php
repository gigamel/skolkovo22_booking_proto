<?php

use Booking\Service\Storage\Connection;

return [
    Connection::class => [
        'dsn' => 'mysql:host=mysql;port=3306;dbname=skolkovo22_booking_proto;charset=utf8',
        'username' => 'skolkovo22',
        'password' => '123',
    ],
];
