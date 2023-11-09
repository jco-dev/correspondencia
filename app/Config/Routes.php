<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('inicio', 'Home::index');

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



