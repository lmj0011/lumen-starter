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
    require base_path('routes/_routes/auth.php');
  });

  $router->group(['prefix' => 'user'], function($router)
  {
    require base_path('routes/_routes/user.php');
  });
});
