<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/** @var object $router **/

$router->get('/', 'HomeController::index');

$router->get('/student', 'StudentController::index');

$router->get('/student/profile', 'StudentController::profile')
       ->middleware('student');

$router->get('/users', 'UsersController::index');

$router->get('/crud', 'CrudController::index');

$router->get('/crud/create', 'CrudController::create');

$router->post('/crud/store', 'CrudController::store');