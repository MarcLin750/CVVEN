<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index'); 
$routes->get('success/', 'home::success');
$routes->get('success/register/', 'home::register');
$routes->get('contact/', 'Home::contact');

$routes->group('logement/', function(RouteCollection $routes){
    $routes->get('/','logement::index');
    $routes->get('type1/','logement::type1');
    $routes->get('type2/','logement::type2');
    $routes->get('type3/','logement::type3');
    $routes->get('type4/','logement::type4');
    $routes->get('type5/','logement::type5');
    $routes->match(['get', 'post'], '(:segment)/', 'logement::getLogement/$1');
});

$routes->group('materiel/', function(RouteCollection $routes){
    $routes->get('/','materiel::index');
    $routes->get('type1/','materiel::type1');
    $routes->get('type2/','materiel::type2');
    $routes->get('type3/','materiel::type3');
    $routes->get('type4/','materiel::type4');
    $routes->get('type5/','materiel::type5');
    $routes->get('type6/','materiel::type6');
    $routes->get('type7/','materiel::type7');
    $routes->match(['get', 'post'], '(:segment)/', 'materiel::reserveMateriel/$1');
    $routes->post('reserve/(:segment)/', 'materiel::reserveMateriel/$1');
});

$routes->group('auth/',  function(RouteCollection $routes){
    $routes->match(['get', 'post'], 'login/', 'Auth::login');
    $routes->match(['get','post'], 'register/', 'Auth::register');
    $routes->get('logout/','Auth::logout');
});

$routes->group('users/', ['filter' => 'authFilter'],function(RouteCollection $routes){
    $routes->get('(:num)/','Users::profil/$1');
    $routes->get('(:num)/cancel/(:segment)/(:segment)/','Users::cancelReservation/$1/$2/$3');
    $routes->get('(:num)/materiel/cancel/(:segment)/(:segment)/','Users::cancelReservationMateriel/$1/$2/$3');
});

$routes->group('admin/', ['filter' => 'authFilter'], function(RouteCollection $routes) {
    $routes->get('dashboard/', 'Admin::dashboard');
    $routes->get('users/', 'Admin::showUsers');
    $routes->get('users/delete/(:num)/', 'Admin::deleteUser/$1');
    $routes->match(['get', 'post'], 'login/', 'Admin::login');
    $routes->match(['get', 'post'], 'register/', 'Admin::register');
    $routes->post('register_validation/', 'Admin::register_validation');
    $routes->post('login_validation/', 'Admin::login_validation');
    $routes->get('reservations/confirm/(:segment)/(:segment)/', 'Admin::confirmReservation/$1/$2');
    $routes->get('reservations/cancel/(:segment)/(:segment)/', 'Admin::cancelReservation/$1/$2');
    $routes->get('reservations/delete/(:segment)/', 'Admin::deleteReservation/$1');
    $routes->get('reservations/materiel/confirm/(:segment)/(:segment)/', 'Admin::confirmReservationMateriel/$1/$2');
    $routes->get('reservations/materiel/cancel/(:segment)/(:segment)/', 'Admin::cancelReservationMateriel/$1/$2');
    $routes->get('reservations/materiel/delete/(:segment)/', 'Admin::deleteReservationMateriel/$1');
});