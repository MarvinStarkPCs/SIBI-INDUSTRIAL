<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'clogin::index');
$routes->get('dashboard', 'chome::index');
$routes->get('inventario', 'cinventario::index');
$routes->get('clogin/logout', 'clogin::logout');
$routes->get('gestion-usuarios', 'CgestionUsarios::index');

$routes->post('clogin/authenticate', 'Clogin::authenticate');
