<?php
// Cargar configuraciones y librerías base
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/libs/Session.php';
require_once __DIR__ . '/libs/Database.php';
require_once __DIR__ . '/libs/Router.php';

// Inicializar el enrutador
$router = new Router();

// Definir rutas de autenticación
$router->add('GET', '/', 'TaskController@index');
$router->add('GET', '/login', 'AuthController@showLogin');
$router->add('POST', '/login', 'AuthController@login');
$router->add('GET', '/registro', 'AuthController@showRegister');
$router->add('POST', '/registro', 'AuthController@register');
$router->add('GET', '/logout', 'AuthController@logout');

// Definir rutas del panel de tareas
$router->add('GET', '/dashboard', 'TaskController@index');
$router->add('GET', '/tareas', 'TaskController@index');
$router->add('GET', '/tareas/crear', 'TaskController@create');
$router->add('POST', '/tareas/crear', 'TaskController@store');
$router->add('GET', '/tareas/editar/{id}', 'TaskController@edit');
$router->add('POST', '/tareas/editar/{id}', 'TaskController@update');
$router->add('POST', '/tareas/eliminar/{id}', 'TaskController@delete');

// Ruta AJAX para cambiar el estado de la tarea
$router->add('POST', '/tareas/toggle/{id}', 'TaskController@toggle');

// Despachar la petición
$router->dispatch();
