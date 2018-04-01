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

$router->group(['prefix' => 'api/v1'], function($router)
{

  $router->group(['prefix' => 'auth'], function($router)
  {
    $router->post('/login', ['uses' => 'AuthController@login', 'as' => 'auth.login']);

    $router->post('/logout', ['middleware' => 'auth', 'uses' => 'AuthController@logout', 'as' => 'auth.logout']);

    $router->post('/me', ['middleware' => 'auth', 'uses' => 'AuthController@me', 'as' => 'auth.me']);

    $router->post('/refresh', ['middleware' => 'auth', 'uses' => 'AuthController@refresh', 'as' => 'auth.refresh']);
  });

  $router->group(['prefix' => 'user'], function($router)
  {
    $router->get('/', ['uses' => 'UsersController@index', 'as' => 'index.user']);

    $router->get('/{id}', ['uses' => 'UsersController@show', 'as' => 'show.user']);

  	$router->post('/', ['uses' => 'UsersController@store', 'as' => 'store.user']);

  	$router->put('/{id}', ['uses' => 'UsersController@update', 'as' => 'update.user']);
    
  	$router->delete('/{id}', ['uses' => 'UsersController@destroy', 'as' => 'destroy.user']);
  });
});
