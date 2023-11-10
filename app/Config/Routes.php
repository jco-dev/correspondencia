<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// login
$routes->get('login', 'Auth::index', ['as' => 'login']);
$routes->post('login', 'Auth::autenticar', ['as' => 'procesar-login']);
$routes->get('cerrar-sesion', 'Auth::salir', ['as' => 'cerrar-sesion', 'filter' => 'auth:ADMINISTRADOR,USUARIO']);


$routes->group('', ['filter' => 'auth:ADMINISTRADOR,USUARIO'], function ($routes) {
    // Inicio
    $routes->get('/', 'Home::index');
    $routes->get('inicio', 'Home::index');

    // Cambiar clave
    $routes->get('vista-cambiar-password', 'Auth::vistaCambiarClave', ['as' => 'vista-cambiar-password']);
    $routes->post('actualizar-clave', 'Auth::actualizarClaveUsuario', ['as' => 'actualizar-clave']);

    // Rutas de documentos
    $routes->get('listado-documentos', 'Documentos::index', ['as' => 'listado-documentos']);
    $routes->get('listado-documentos-ajax', 'Documentos::listadoDocumentosAjax', ['as' => 'listado-documentos-ajax']);
    $routes->post('crear-documento', 'Documentos::vistaAgregar', ['as' => 'crear-documento']);
    $routes->post('registro-documento', 'Documentos::store', ['as' => 'registro-documento']);
    $routes->post('editar-documento', 'Documentos::edit', ['as' => 'editar-documento']);
    $routes->post('actualizar-documento', 'Documentos::update', ['as' => 'actualizar-documento']);
    $routes->get('descargar-documento/(:num)', 'Documentos::descargar/$1', ['as' => 'descargar-documento']);
    $routes->post('eliminar-archivo', 'Documentos::eliminarArchivo', ['as' => 'eliminar-archivo']);
});


$routes->group('', ['filter' => 'auth:ADMINISTRADOR'], function ($routes) {
    // Rutas para personas
    $routes->get('listado-personas', 'Persona::index', ['as' => 'listado-personas']);
    $routes->get('listado-personas-ajax', 'Persona::listadoPersonasAjax', ['as' => 'listado-personas-ajax']);
    $routes->post('verificar-ci', 'Persona::VerificarPersona', ['as' => 'verificar-ci']);
    $routes->post('crear-persona', 'Persona::vistaAgregar', ['as' => 'crear-persona']);
    $routes->post('registro-persona', 'Persona::store', ['as' => 'registro-persona']);
    $routes->post('editar-persona', 'Persona::edit', ['as' => 'editar-persona']);
    $routes->post('actualizar-persona', 'Persona::update', ['as' => 'actualizar-persona']);

    // Rutas para oficinas
    $routes->get('listado-oficinas', 'Oficina::index', ['as' => 'listado-oficinas']);
    $routes->get('listado-oficinas-ajax', 'Oficina::listadoOficinasAjax', ['as' => 'listado-oficinas-ajax']);
    $routes->post('crear-oficina', 'Oficina::vistaAgregar', ['as' => 'crear-oficina']);
    $routes->post('registro-oficina', 'Oficina::store', ['as' => 'registro-oficina']);
    $routes->post('editar-oficina', 'Oficina::edit', ['as' => 'editar-oficina']);
    $routes->post('actualizar-oficina', 'Oficina::update', ['as' => 'actualizar-oficina']);

    // Rutas para asignacion de oficinas
    $routes->get('listado-asignacion-oficinas', 'AsignacionOficina::index', ['as' => 'listado-asignacion']);
    $routes->get('listado-asignacion-ajax', 'AsignacionOficina::listadoAsignacionAjax', ['as' => 'listado-asignacion-ajax']);
    $routes->post('crear-asignacion', 'AsignacionOficina::vistaAgregar', ['as' => 'crear-asignacion']);
    $routes->post('registro-asignacion', 'AsignacionOficina::store', ['as' => 'registro-asignacion']);
    $routes->post('editar-asignacion', 'AsignacionOficina::edit', ['as' => 'editar-asignacion']);
    $routes->post('actualizar-asignacion', 'AsignacionOficina::update', ['as' => 'actualizar-asignacion']);
    $routes->post('finalizar-asignacion', 'AsignacionOficina::finalizar', ['as' => 'finalizar-asignacion']);
});





