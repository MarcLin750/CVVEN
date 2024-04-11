<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::view');
$routes->get('logement', 'Logement::view');

$routes->group('auth',  function(RouteCollection $routes){
    $routes->match(['get', 'post'], 'login', 'Auth::login');
    $routes->match(['get','post'], 'register', 'Auth::register');
    $routes->get('logout','Auth::logout');
});

$routes->group('users', ['filter' => 'authFilter'],function(RouteCollection $routes){
    $routes->get('profil','Users::logout');
});