<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// M1 – učebne
$routes->get('rooms', 'Rooms::index');