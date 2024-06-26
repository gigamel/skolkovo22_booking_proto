<?php

declare(strict_types=1);

use Booking\Routing\RoutesCollection;

$routesCollection = new RoutesCollection();

$routesCollection->route('estates', '/estates/', 'skolkovo22.estates');
$routesCollection->route('estates_pages', '/estates/{page_attr_name}/{page_number}', 'skolkovo22.estates');
$routesCollection->route('estate', '/estate/{entity_id}', 'skolkovo22.estates.estate');

return $routesCollection;
