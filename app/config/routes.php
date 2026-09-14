<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/** @var object $router **/

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
$router->get('/', 'HomeController::index');


/*
|--------------------------------------------------------------------------
| STUDENT PAGES
|--------------------------------------------------------------------------
*/
$router->get('/student', 'StudentController::index');

$router->get('/student/profile', 'StudentController::profile')
       ->middleware('student');


/*
|--------------------------------------------------------------------------
| USERS TABLE
|--------------------------------------------------------------------------
*/
$router->get('/users', 'UsersController::index');


/*
|--------------------------------------------------------------------------
| LAB 4 - CRUD USERS
|--------------------------------------------------------------------------
*/
$router->get('/crud', 'CrudController::index');

$router->get('/crud/create', 'CrudController::create');

$router->post('/crud/store', 'CrudController::store');

$router->get('/crud/edit/{id}', 'CrudController::edit');

$router->post('/crud/update/{id}', 'CrudController::update');

$router->get('/crud/delete/{id}', 'CrudController::delete');


/*
|--------------------------------------------------------------------------
| LAB 5 - AUTHENTICATION
|--------------------------------------------------------------------------
*/
$router->get('/lab5', 'AuthController::index');

$router->get('/signup', 'AuthController::signup');

$router->post('/signup/store', 'AuthController::store');

$router->get('/login', 'AuthController::login');

$router->post('/login/authenticate', 'AuthController::authenticate');

$router->get('/logout', 'AuthController::logout');


/*
|--------------------------------------------------------------------------
| PRODUCTS CRUD (PROTECTED)
|--------------------------------------------------------------------------
*/
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

       $router->get('/test-session', 'AuthController::testSession');

       $router->get('/test', function() {
    die('TEST PAGE WORKING');
});