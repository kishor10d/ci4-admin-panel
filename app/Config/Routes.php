<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->get('/login', 'Login::index');
$routes->post('/', 'Login::index');

$routes->get('/dashboard', 'Dashboard::index', ['filter'=>'auth']);
$routes->get('/logout', 'User::logout', ['filter'=>'auth']);

$routes->get('/users', 'User::index', ['filter'=>'auth']);
$routes->get('/fetchUsers', 'User::fetchUsers');

$routes->get('/users/create', 'User::create', ['filter'=>'auth']);
$routes->get('/users/edit', 'User::edit', ['filter'=>'auth']);