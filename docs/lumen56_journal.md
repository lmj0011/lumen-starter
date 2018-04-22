<!--  
TODO

list system requirements:
php7.1, mysql version?

other tools I'm using:
mysqlworkbench

-->

# Install and Setup

### install Lumen using the Lumen Installer

https://lumen.laravel.com/docs/5.6#installing-lumen

`lumen new lumen-5.6-proj`

### create `.env`

`cp .env.example .env`

### create a new mysql db

I created a db named `lumen56_db` using mysql workbench

then updated the `DB_*` vars in my `.env` to:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lumen56_db
DB_USERNAME=root
DB_PASSWORD=root
```

where the DB credentials are of my `root` mysql user

### make an APP_KEY

make up a random 32 char length string, and then update `APP_KEY` in the `.env`

I got one from here: http://www.sethcardoza.com/tools/random-password-generator/


### verify setup by serving the app

run `php -S localhost:8000 -t public` from the project's root

go to `localhost:8000` in the web browser to verify basic setup is good, you should see something like:

```
Lumen (5.6.2) (Laravel Components 5.6.*)
```

### set up version control

doing this to keep up with local file changes.
You don't necessary have to push anything to a "remote"

`git init`

`git add .`

`git commit -m "initial commit"`

# Adding Eloquent ORM

I will attempt to set a simple DB Model, User.

### Enable Eloquent

>you should uncomment the $app->withEloquent() call in your bootstrap/app.php file.

https://lumen.laravel.com/docs/5.6/database

### create a migration

I'm creating a Users table in my DB

`php artisan make:migration create_users_table`

add any desired columns to your table Schema, in the generated migration file.

### run migration

`php artisan migrate`

### test creating a new User

I created a GET route named `new-user` to test with.

in `routes/web.php`, I added:

```
$router->get('new-user', ['uses' => 'UsersController@addNewUser', 'as' => 'new.user']);
```

I then added a new Controller named `UsersController`

in `app/Http/Controllers/UsersController.php`, I added this method:

```php
<?php

// [...]

public function addNewUser()
{
    $user = new User;
    $user->username = "dankEngine" . rand(100, 999);
    $user->email = str_random(5) . "@gmail.com";
    $user->password = str_random(5);
    $user->save();

    return $user;
}
```

I started up the server `php -S localhost:8000 -t public`, went to `localhost:8000/new-user` and got this as a response.

```
{"username":"dankEngine817","email":"juM9W@gmail.com","updated_at":"2018-03-16 22:42:43","created_at":"2018-03-16 22:42:43","id":1}
```

I checked the Database, and the model was saved.

This concluded testing my Eloquent ORM setup.

<!-- reference commit 7b4ab9f96423e9f5b49fca2267e2d2e6c516eda0 here -->


# Refining and Adding routes to the UsersController

Here I plan to add more RESTful routes for the `UsersController`

In the `UsersController`, I added these Restful methods.

```php
<?php

// [...]

public function index(Request $request): JsonResponse
{
  $users  = User::all();

  return response()->json($users);
}

public function show(Request $request, $id): JsonResponse
{
  $user = User::find($id);

  return response()->json($user);
}

public function store(Request $request): JsonResponse
{
 $user = new User;
 $user->username = $request->input('username');
 $user->email = $request->input('email');
 $user->password = $request->input('password');
 $user->save();

 return  response()->json($user);
}

public function update(Request $request, $id): JsonResponse
{
 $user = User::find($id);

 if ($request->input('username')) {
   $user->username = $request->input('username');
 }

 if ($request->input('email')) {
   $user->email = $request->input('email');
 }

 $user->save();

 return response()->json($user);
}

public function destroy(Request $request, $id): JsonResponse
{
 $user = User::find($id);

 $user->delete();

 return response()->json('User:' . $user->username . ' Removed.');
}
```

I created an Interface named `RestfulModelInterface`
that `UsersController` implements.

```php
<?php

// [...]

interface RestfulModelInterface {

    // HTTP VERB GET
    public function index(Request $request): JsonResponse;

    // HTTP VERB GET
    public function show(Request $request, $id): JsonResponse;

    // HTTP VERB PUT
    public function update(Request $request, $id): JsonResponse;

    // HTTP VERB POST
    public function store(Request $request): JsonResponse;

    // HTTP VERB DELETE
    public function destroy(Request $request, $id): JsonResponse;
}
```

The `RestfulModelInterface` Interface should come handy for future Controllers.



These are the routes that supplement the `UsersController` in `routes/web.php`

```php
<?php

// [...]

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
```


You can test these routes using the curl commands documented in `docs/route_testing.md`


<!--  
ref commit: 115836e1790207e63d640bd36e3b312d0886973a here

ref: https://www.cloudways.com/blog/creating-rest-api-with-lumen/
-->

# Adding Authentication

- JSON Web Tokens will be the authentication method for this app;
using https://github.com/tymondesigns/jwt-auth

- After following the guide here http://jwt-auth.readthedocs.io/en/develop/lumen-installation/, I was able todo get
JWT setup in my app.

- the main thing that had to be changed that previously wasn't a problem, was to make sure I was hashing the Users
password before saving it to the database. see: https://github.com/tymondesigns/jwt-auth/issues/1290#issuecomment-377153100

<!-- reference commit 9d315926096ef2594e5253ba91e4f33b5693d7a3 here -->

# Test Writing

Here I will write tests for the current API routes.
These will be Integration Tests.


In the `tests/` directory, I created a file named `UsersApiTest.php` and wrote tests functions,
following the documentation here https://lumen.laravel.com/docs/5.6/testing#testing-json-apis


### Run Tests

to run all tests `./vendor/bin/phpunit`

to run only the api (integration) tests: `./vendor/bin/phpunit --group api`

to run only the unit tests: `./vendor/bin/phpunit --group unit`

<!-- reference commit 15390efcbc73698a7e7a914cc39591d90d5ca5cb here -->


# Adding App Documentation

- I set up API docs with [Sami](https://github.com/FriendsOfPHP/Sami)

```sh
# generate api docs
php sami.phar update sami_config.php

# serve up docs for viewing in the web browser
php -S localhost:8080 -t docs/api/app/
```

- I set up API endpoint docs with [apidoc.js](http://apidocjs.com/)

```
# generate api endpoint docs
npm run apidoc:build

# serve up docs for viewing in the web browser
php -S localhost:8081 -t docs/api/routes/
```
