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

$router->get('/', 'PresentationController@presentation');

$router->get('/check', 'UserController@listProfiles');

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
 * Update users
 */
$router->post('/user/update','UserController@update');

/**
 * Update users
 */
$router->post('/user/change/password','UserController@updatePassword');

/**
 * Get All users
 */
$router->get('/user/list','UserController@getAll');

/**
 * Get user by id
 */
$router->get('/user/index/{id}','UserController@getById');

/**
 * Get user by profile
 */
$router->get('/user/profile/{profile}','UserController@getByProfile');

/**
 * Update state user by id
 */
$router->post('/user/change/state','UserController@updateState');

/**
 * Module FoodDish
 */
$router->post('/fooddish/create','FoodDishController@create');
$router->get('/fooddish/delete/{id}','FoodDishController@delete');
$router->post('/fooddish/update','FoodDishController@update');
$router->get('/fooddish/list','FoodDishController@list');
$router->get('/fooddish/index/{id}','FoodDishController@getFoodDishById');
$router->get('/fooddish/category/{id_category}','FoodDishController@getFoodDishByCategory');


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


/**
 * Module event
 */
$router->post('/event/create','EventController@create');
$router->get('/event/delete/{id}','EventController@delete');
$router->post('/event/update','EventController@update');
$router->post('/event/dish','EventController@addFoodDish');
$router->get('/event/list','EventController@list');
$router->get('/event/index/{id}','EventController@getEventById');
$router->get('/event/chef/{id_chef}','EventController@getEventByChef');

/**
 * event state
 */
$router->post('/eventstate/create','EventStateController@create');
$router->get('/eventstate/delete/{id}','EventStateController@delete');
$router->post('/eventstate/update','EventStateController@update');
$router->get('/eventstate/list','EventStateController@list');
$router->get('/eventstate/index/{id}','EventStateController@getEventStateById');

/**
 * Califications Categories
 */
$router->get('/calificationcategory/list','CalificationCategoryController@getAll');

/**
 * Califications 
 */
$router->post('/calification/create','CalificationController@create');
$router->get('/calification/chef/{id_chef}','CalificationController@getByChef');

/**
 * Reservation 
 */
$router->post('/reservation/create','ReservationController@create');
$router->get('/reservation/index/{id}','ReservationController@getById');
$router->get('/reservation/costumer/{id_costumer}','ReservationController@getByCostumer');
$router->get('/reservation/chef/{id_chef}','ReservationController@getByChef');
$router->get('/reservation/state/costumer/{id_state}/{id_costumer}','ReservationController@getByCostumerByState');
$router->get('/reservation/state/chef/{id_state}/{id_chef}','ReservationController@getByChefByState');
$router->post('/reservation/state','ReservationController@changeState');

/**
 * Reports 
 */
$router->get('/report/users-profile','ReportController@userPerProfileCount');
$router->get('/report/user/{id_profile}/{id_state}','ReportController@userPerProfilePerStateCount');
$router->get('/report/events/list','ReportController@eventsCount');
$router->get('/report/events/chef','ReportController@eventsPerChefCount');