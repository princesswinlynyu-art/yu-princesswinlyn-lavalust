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

$router->get('/crud/edit/{id}', 'CrudController::edit');

$router->post('/crud/update/{id}', 'CrudController::update');

$router->get('/crud/delete/{id}', 'CrudController::delete');



$router->get('/lab5', 'AuthController::index');

$router->get('/signup', 'AuthController::signup');

$router->post('/signup/store', 'AuthController::store');

$router->get('/login', 'AuthController::login');

$router->post('/login/authenticate', 'AuthController::authenticate');

$router->get('/logout', 'AuthController::logout');



$router->get('/products', 'ProductController::index')
       ->middleware('auth');

$router->get('/products/create', 'ProductController::create')
       ->middleware('auth');

$router->post('/products/store', 'ProductController::store')
       ->middleware('auth');

$router->get('/products/edit/{id}', 'ProductController::edit')
       ->middleware('auth');

$router->post('/products/update/{id}', 'ProductController::update')
       ->middleware('auth');

$router->get('/products/delete/{id}', 'ProductController::delete')
       ->middleware('auth');


/*
|--------------------------------------------------------------------------
| API ROUTES
|--------------------------------------------------------------------------
*/

$router->post('/api/login', 'ProductApiController::login');
$router->post('/api/register', 'ProductApiController::register');

$router->get('/api/products', 'ProductApiController::index');
$router->get('/api/products/{id}', 'ProductApiController::show');
$router->post('/api/products', 'ProductApiController::store');
$router->put('/api/products/{id}', 'ProductApiController::update');
$router->patch('/api/products/{id}', 'ProductApiController::patch');
$router->delete('/api/products/{id}', 'ProductApiController::delete');

// Let the API library answer browser CORS preflight requests before the
// method-specific API handlers are reached.
$router->options('/api/login', 'ProductApiController::login');
$router->options('/api/register', 'ProductApiController::register');
$router->options('/api/products', 'ProductApiController::index');
$router->options('/api/products/{id}', 'ProductApiController::show');

$router->get('/api-demo', 'ProductApiController::demo');


/*
|--------------------------------------------------------------------------
| MIGRATION ROUTES
|--------------------------------------------------------------------------
*/

$router->get('/create-migration/{migration_class}',
             'MigrationController::create_migration');

$router->get('/migrate',
             'MigrationController::migrate');

$router->get('/rollback',
             'MigrationController::rollback');

$router->get('/rollback-all',
             'MigrationController::rollback_all');

$router->get('/refresh',
             'MigrationController::refresh');

$router->get('/status',
             'MigrationController::status');
