<?php

declare(strict_types=1);

use Booking\Routing\RoutesCollection;

$routesCollection = new RoutesCollection([
    'entity_id' => '[0-9]+',
    'entity_type' => '[a-z]+',
    'page_number' => '[0-9]+',
    'page_attr_name' => 'page',
]);

$routesCollection->route('estates', '/estates/', 'skolkovo22.estates');
$routesCollection->route('estates_pages', '/estates/{page_attr_name}/{page_number}', 'skolkovo22.estates.pages');
$routesCollection->route('estates_category', '/estates/{entity_type}/', 'skolkovo22.estates.category');
$routesCollection->route('estates_category_pages', '/estates/{entity_type}/{page_attr_name}/{page_number}', 'skolkovo22.estates.category.pages');

return $routesCollection;
