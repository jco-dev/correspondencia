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

    // Rutas de envios hoja ruta enviados
    $routes->get('listado-enviados', 'EnvioHojaRuta::index', ['as' => 'listado-enviados']);
    $routes->get('listado-enviados-ajax', 'EnvioHojaRuta::listadoEnviadosAjax', ['as' => 'listado-enviados-ajax']);
    $routes->post('crear-envio', 'EnvioHojaRuta::vistaAgregar', ['as' => 'crear-envio']);
    $routes->post('cargar-referencia', 'EnvioHojaRuta::referenciaDocumento', ['as' => 'cargar-referencia']);
    $routes->post('registro-envio', 'EnvioHojaRuta::store', ['as' => 'registro-envio']);
    $routes->post('cancelar-envio', 'EnvioHojaRuta::cancelarEnvio', ['as' => 'cancelar-envio']);

    // Rutas de envios hoja ruta entrantes
    $routes->get('listado-entrantes', 'EnvioHojaRuta::indexEntrantes', ['as' => 'listado-entrantes']);
    $routes->get('listado-entrantes-ajax', 'EnvioHojaRuta::listadoEntrantesAjax', ['as' => 'listado-entrantes-ajax']);
    $routes->post('recibir-entrante', 'EnvioHojaRuta::recibirEntrante', ['as' => 'recibir-entrante']);

    // Rutas de envios hoja ruta pendientes
    $routes->get('listado-pendientes', 'EnvioHojaRuta::indexPendientes', ['as' => 'listado-pendientes']);
    $routes->get('listado-pendientes-ajax', 'EnvioHojaRuta::listadoPendientesAjax', ['as' => 'listado-pendientes-ajax']);
    $routes->post('archivar-pendiente', 'EnvioHojaRuta::archivarPendiente', ['as' => 'archivar-pendiente']);

    // Rutas de envios hoja ruta archivados
    $routes->get('listado-archivados', 'EnvioHojaRuta::indexArchivados', ['as' => 'listado-archivados']);
    $routes->get('listado-archivados-ajax', 'EnvioHojaRuta::listadoArchivadosAjax', ['as' => 'listado-archivados-ajax']);
    $routes->post('desarchivar-archivado', 'EnvioHojaRuta::desarchivarArchivado', ['as' => 'desarchivar-archivado']);
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





