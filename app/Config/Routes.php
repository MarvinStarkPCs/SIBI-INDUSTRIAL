<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//rutas por vista

//authentication
$routes->get('/', 'clogin::index');
$routes->post('clogin/authenticate', 'Clogin::authenticate');
$routes->post('cambiar-contrasena/actualizar', 'CambioContrasena::actualizar');
$routes->get('clogin/logout', 'clogin::logout');

//dashboard
$routes->get('dashboard', 'chome::index');

//inventario
$routes->get('inventario', 'cinventario::index');

//seguridad
///Gestion de usuarios
$routes->get('gestion-usuarios', 'CgestionUsarios::index');
$routes->get('gestion-usuarios/deleteusuario/(:num)', 'CgestionUsarios::deleteusuario/$1');
$routes->post('gestion-usuarios/addusuarios/', 'CgestionUsarios::addusuario');

///Cambier contraseña
$routes->get('cambiar-contrasena', 'CambioContrasena::index');

//Gestion de extras
$routes->get('gestion-extras', 'Cgestionextra::index');
///articulos
$routes->get('/articulos', 'ArticuloController::index');
$routes->post('/articulos/store', 'ArticuloController::store');
$routes->post('/articulos/update/(:num)', 'ArticuloController::update/$1');
$routes->get('/articulos/delete/(:num)', 'ArticuloController::delete/$1');


