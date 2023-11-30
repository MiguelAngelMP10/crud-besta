<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('people', 'People::index');
$routes->post('people/storeOrUpdate', 'People::createOrEdit');
$routes->get('people/(:num)', 'People::show/$1');
$routes->get('people/delete/(:num)', 'People::delete/$1');
$routes->get('people/restore/(:num)', 'People::restore/$1');