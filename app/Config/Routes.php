<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::view');
$routes->get('/logement', 'Logement::view');

$routes->get('admin-page', 'AdminController::admin');
