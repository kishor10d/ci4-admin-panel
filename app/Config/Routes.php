<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->get('/login', 'Login::index');
$routes->post('/', 'Login::index');

// $routes->get('/dashboard', 'Dashboard::index');
$routes->get('/dashboard', 'Dashboard::index', ['filter'=>'auth']);

