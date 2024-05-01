<?php

declare(strict_types=1);

use Booking\Routing\RoutesCollection;

$routesCollection = new RoutesCollection();

$routesCollection->route('estates', '/estates/', 'skolkovo22.estates');
$routesCollection->route('estates_pages', '/estates/{page_attr_name}/{page_number}', 'skolkovo22.estates.pages');
$routesCollection->route('estates_category', '/estates/{entity_type}/', 'skolkovo22.estates.category');
$routesCollection->route('estates_category_pages', '/estates/{entity_type}/{page_attr_name}/{page_number}', 'skolkovo22.estates.category.pages');

return $routesCollection;
