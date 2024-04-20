<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::view');

$routes->group('logement', function(RouteCollection $routes){
    $routes->get('/','logement::view');
    $routes->get('type1','logement::type1');
    $routes->get('type2','logement::type2');
    $routes->get('type3','logement::type3');
    $routes->get('type4','logement::type4');
    $routes->get('type5','logement::type5');
    $routes->match(['get', 'post'], '(:segment)', 'logement::getLogement/$1');
});

$routes->group('materiel', function(RouteCollection $routes){
    $routes->get('/','materiel::view');
    $routes->get('type1','materiel::type1');
    $routes->get('type2','materiel::type2');
    $routes->get('type3','materiel::type3');
    $routes->get('type4','materiel::type4');
    $routes->get('type5','materiel::type5');
});

$routes->group('auth',  function(RouteCollection $routes){
    $routes->match(['get', 'post'], 'login', 'Auth::login');
    $routes->match(['get','post'], 'register', 'Auth::register');
    $routes->get('logout','Auth::logout');
});

$routes->group('users', ['filter' => 'authFilter'],function(RouteCollection $routes){
    $routes->get('profil','Users::logout');
});

$routes->group('admin', ['filter' => 'authFilter'], function(RouteCollection $routes) {
    $routes->get('dashboard', 'Admin::index');
    $routes->get('reservations/confirm/(:num)', 'Admin::confirmReservation/$1');
    $routes->get('reservations/cancel/(:num)', 'Admin::cancelReservation/$1');
    $routes->get('users', 'Admin::showUsers');
});