<?php

use Booking\Routing\Router;
use Booking\Service\Storage\Connection;

return [
    Router::class => [
        'segments' => [
            'entity_id' => '[0-9]+',
            'entity_type' => '[a-z]+',
            'page_number' => '[0-9]+',
            'page_attr_name' => 'page',
        ],
    ],
    Connection::class => [
        'dsn' => 'mysql:host=mysql;port=3306;dbname=skolkovo22_booking_proto;charset=utf8',
        'username' => 'skolkovo22',
        'password' => '123',
    ],
];
