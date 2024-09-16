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
$routes->post('inventario/open', 'cinventario::insertinventario');
$routes->get('inventario/inventario-excel', 'cinventario::descargarInventarioExcel');
$routes->post('/inventario/dardebaja/(:num)', 'CInventario::dardebaja/$1');
$routes->post('/inventario/actualizar/(:num)', 'CInventario::actualizar/$1');


//Asignar Articulo
$routes->get('asignar-articulo', 'AsignarArticuloController::index');
$routes->post('asignar-articulo/save', 'AsignarArticuloController::asignar');
$routes->post('asignar-articulo/obtener-estado-ubicacion', 'AjaxAsignarController::obtenerEstadoUbicacion');

//seguridad
///Gestion de usuarios
$routes->get('gestion-usuarios', 'CgestionUsarios::index');
$routes->get('gestion-usuarios/deleteusuario/(:num)', 'CgestionUsarios::deleteusuario/$1');
$routes->post('gestion-usuarios/addusuarios/', 'CgestionUsarios::addusuario');
$routes->post('gestion-usuarios/editusuario/(:num)', 'CgestionUsarios::updateusuario/$1');

///Cambier contraseña
$routes->get('cambiar-contrasena', 'CambioContrasena::index');

//Gestion de extras
$routes->get('gestion-extras', 'Cgestionextra::index');
///articulos
$routes->get('/articulos', 'ArticuloController::index');
$routes->post('/articulos/addusuarios', 'ArticuloController::store');
$routes->post('/articulos/update/(:num)', 'ArticuloController::update/$1');
$routes->get('/articulos/delete/(:num)', 'ArticuloController::delete/$1');
$routes->get('/articulos/articulos-excel', 'ArticuloController::ArticuloExcel');
///categorias.
$routes->get('/categorias', 'CategoriaController::index');
$routes->post('/categorias/add', 'CategoriaController::store');
$routes->post('/categorias/update/(:num)', 'CategoriaController::update/$1');
$routes->get('/categorias/delete/(:num)', 'CategoriaController::delete/$1');
///estados.
$routes->get('/estados', 'EstadosController::index');
$routes->post('/estados/add', 'EstadosController::store');
$routes->post('/estados/update/(:num)', 'EstadosController::update/$1');
$routes->get('/estados/delete/(:num)', 'EstadosController::delete/$1');
///sedes
$routes->get('/sedes', 'SedesController::index');

///Ubicacion
$routes->get('/ubicaciones', 'UbicacionesController::index');
$routes->post('/ubicaciones/add', 'UbicacionesController::store');
$routes->post('/ubicaciones/update/(:num)', 'UbicacionesController::update/$1');
$routes->get('/ubicaciones/delete/(:num)', 'UbicacionesController::delete/$1');
$routes->get('/ubicaciones/ubicaciones-excel', 'UbicacionesController::ubicacioneExcel');
///procedencias
$routes->get('/procedencias', 'ProcedenciasController::index');
$routes->post('/procedencias/add', 'ProcedenciasController::store');
$routes->post('/procedencias/update/(:num)', 'ProcedenciasController::update/$1');
$routes->get('/procedencias/delete/(:num)', 'ProcedenciasController::delete/$1');
$routes->get('/procedencias/procedencias-excel', 'ProcedenciasController::procedenciasExcel');

//historial
///Histroial asignaciones
$routes->get('/asignaciones', 'AsignacionesController::index');

//historial inventario
$routes->get('/inventarios-anteriores', 'HistorialInventarioController::index');
$routes->get('/inventarios-anteriores/inventario-excel', 'HistorialInventarioController::descargarInventarioExcel');

//historial dados de baja
$routes->get('/dados-de-baja', 'DadosdebajaController::index');
$routes->get('/dados-de-baja/inventario-excel', 'DadosdebajaController::descargarInventarioExcel');
