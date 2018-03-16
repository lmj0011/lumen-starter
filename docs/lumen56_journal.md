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

```
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

I checked the DB and the model was saved.

This concluded testing my Eloquent ORM setup.


<!--  

# Refining and Adding more routes for the User model

Here I plan to add more RESTful routes for User

ref: https://www.cloudways.com/blog/creating-rest-api-with-lumen/
-->



<!-- # Adding authentication

I will now attempt to set up authentication using `lumen-passport`
https://github.com/dusterio/lumen-passport

### activate AuthServiceProvider -->
