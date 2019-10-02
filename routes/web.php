<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/**
 * Login Administration route
 */
$router->post('/auth/login/admin', 'AuthController@loginAdmin');

/**
 * Login Chef route
 */
$router->post('/auth/login/chef', 'AuthController@loginChef');

/**
 * Login Costumer route
 */
$router->post('/auth/login/costumer', 'AuthController@loginCostumer');