<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// M1 – učebne
$routes->get('rooms', 'Rooms::index');
$routes->get('rooms/(:num)', 'Rooms::show/$1');
$routes->get('rooms/new', 'Rooms::new');
$routes->post('rooms', 'Rooms::create');
