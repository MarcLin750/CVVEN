<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('facilities-page', 'FacilitiesController::facilities');
$routes->get('admin-page', 'AdminController::admin');
$route['default_controller'] = 'login';
$route['login'] = 'login';
$route['admin_panel'] = 'admin_panel'; // Assurez-vous de créer ce contrôleur et cette méthode




