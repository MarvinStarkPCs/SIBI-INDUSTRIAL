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
///Gestion de usuarios crud
$routes->get('gestion-usuarios', 'CgestionUsarios::index');
$routes->get('gestion-usuarios/deleteusuario/(:num)', 'CgestionUsarios::deleteusuario/$1');
$routes->post('gestion-usuarios', 'CgestionUsarios::addusuario');



$routes->get('cambiar-contrasena', 'CambioContrasena::index');
