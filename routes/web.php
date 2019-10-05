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

/**
 * Register users
 */
$router->post('/user/create','UserController@create');


/**
 * Module FoodDish
 */
$router->post('/fooddish/create','FoodDishController@create');
$router->get('/fooddish/delete/{id}','FoodDishController@delete');
$router->post('/fooddish/update','FoodDishController@update');
$router->get('/fooddish/list','FoodDishController@list');
$router->get('/fooddish/index/{id}','FoodDishController@getFoodDishById');

/**
 * Module event
 */
$router->post('/event/create','EventController@create');
$router->get('/event/delete/{id}','EventController@delete');
$router->post('/event/update','EventController@update');
$router->get('/event/list','EventController@list');
$router->get('/event/index/{id}','EventController@getEventById');