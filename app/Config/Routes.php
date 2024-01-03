<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Main::index');
$routes->get('Main/changetheme', 'Main::changetheme');
$routes->get('Login', 'Login::index');

use App\Controllers\Pages;
$routes->get('(:segment)', [Pages::class, 'view']);


