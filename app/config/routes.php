<?php

declare(strict_types=1);

use Booking\Routing\RoutesCollection;

$routesCollection = new RoutesCollection([
    'entity_id' => '[0-9]+',
    'entity_type' => '[a-z]+',
    'page_number' => '[0-9]+',
    'page_attr_name' => 'page',
]);

$routesCollection->route('skolkovo22.estates', '/estates/');
$routesCollection->route('skolkovo22.estates.pages', '/estates/{page_attr_name}/{page_number}');
$routesCollection->route('skolkovo22.estates.category', '/estates/{entity_type}/');
$routesCollection->route('skolkovo22.estates.category.pages', '/estates/{entity_type}/{page_attr_name}/{page_number}');

return $routesCollection;
