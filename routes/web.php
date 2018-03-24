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


$router->group(['prefix' => 'api/v1'], function($router)
{
  $router->group(['prefix' => 'user'], function($router)
  {
    $router->get('/', ['uses' => 'UsersController@index', 'as' => 'index.user']);
    $router->get('/{id}', ['uses' => 'UsersController@show', 'as' => 'show.user']);
  	$router->post('/', ['uses' => 'UsersController@store', 'as' => 'store.user']);
  	$router->put('/{id}', ['uses' => 'UsersController@update', 'as' => 'update.user']);
  	$router->delete('/{id}', ['uses' => 'UsersController@destroy', 'as' => 'destroy.user']);
  });
});
