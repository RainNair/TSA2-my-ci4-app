<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'TaskController::welcome', ['filter' => 'auth']);
$routes->get('/tasks', 'TaskController::index', ['filter' => 'auth']);
$routes->get('/profile', 'TaskController::profile', ['filter' => 'auth']);
$routes->get('/about', 'TaskController::about', ['filter' => 'auth']);

$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::attemptLogin');
$routes->post('/logout', 'AuthController::logout', ['filter' => 'auth']);

$routes->get('/tasks/new', 'TaskController::newTask', ['filter' => 'auth']);
$routes->post('/tasks', 'TaskController::create', ['filter' => 'auth']);
$routes->get('/tasks/(:num)/edit', 'TaskController::edit/$1', ['filter' => 'auth']);
$routes->post('/tasks/(:num)', 'TaskController::update/$1', ['filter' => 'auth']);
$routes->post('/tasks/(:num)/delete', 'TaskController::delete/$1', ['filter' => 'auth']);
