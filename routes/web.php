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
 * Module FoodDishState
 */
$router->post('/fooddishstate/create','FoodDishStateController@create');
$router->get('/fooddishstate/delete/{id}','FoodDishStateController@delete');
$router->post('/fooddishstate/update','FoodDishStateController@update');
$router->get('/fooddishstate/list','FoodDishStateController@list');
$router->get('/fooddishstate/index/{id}','FoodDishStateController@getFoodDishStateById');

/**
 * Module CategoryFood
 */
$router->post('/categoryfood/create','CategoryFoodController@create');
$router->get('/categoryfood/delete/{id}','CategoryFoodController@delete');
$router->post('/categoryfood/update','CategoryFoodController@update');
$router->get('/categoryfood/list','CategoryFoodController@list');
$router->get('/categoryfood/index/{id}','CategoryFoodController@getFoodDishStateById');

