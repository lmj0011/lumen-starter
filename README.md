# lumen-starter

An api backend made with Lumen.

- What's Included
- Requirements
- Installation
- Testing
- API Documentation


### What's Included

- Lumen 5.6
- Authentication with JSON Web Tokens (JWT)
- apidoc.js documentation for the route endpoints
- Sami documentation for the API
- A ready to go Users Model/Controller setup

### Requirements

- php 7.1 or higher
- node.js 8 or higher

### Installation

- with Git

```sh
#TODO
```

- download dependencies

```sh
composer install

npm install
```

- run the app

```sh
cd myapi

php -S localhost:8000 -t public
```


### Testing

- to run all tests for the app:

`./vendor/bin/phpunit`

- to run **only** the unit tests:

`./vendor/bin/phpunit --group unit`

- to run **only** the integration tests (the api endpoints):

`./vendor/bin/phpunit --group api`


### API Documentation

- There are 2 types of docs that can be generated right away.

- API docs generated with [Sami](https://github.com/FriendsOfPHP/Sami)

```sh
# generate api docs
php sami.phar update sami_config.php

# serve up docs for viewing in the web browser
php -S localhost:8080 -t docs/api/app/
```
- API **endpoints** docs generated with [apidoc.js](http://apidocjs.com/)

```sh
# generate api endpoint docs
npm run apidoc:build

# serve up docs for viewing in the web browser
php -S localhost:8080 -t docs/api/routes/
```

### License

The Lumen framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
