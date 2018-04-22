<?php

/**
 * @apiDefine None no authentication required
 * No authentication is required, to successfully make this api call
 */

/**
 * @apiDefine Auth authentication required
 * Must use valid header token, to successfully make this api call.
 */


 /**
 * @api {get} api/v1/user Get a list of Users
 * @apiVersion 0.0.0
 * @apiPermission None
 * @apiName index.user
 * @apiGroup user
 *
 *
 * @apiHeaderExample {json} Request Header:
 *     {
 *       "Content-Type": "application/json"
 *     }
 *
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 * {
 *    [
 *         {
 *             "id": 1,
 *             "username": "tpain2105",
 *             "email": "tpain2105@gmails.com",
 *             "deleted_at": null,
 *             "created_at": "2018-04-10 03:59:34",
 *             "updated_at": "2018-04-10 03:59:34"
 *         }
 *		]
 * }
 *
 *
 *
 */
 $router->get('/', ['middleware' => 'auth', 'uses' => 'UsersController@index', 'as' => 'index.user']);
 //

 /**
 * @api {get} api/v1/user/{id} Get a User by id
 * @apiVersion 0.0.0
 * @apiPermission None
 * @apiName show.user
 * @apiGroup user
 *
 * @apiParam {Number} id The id of the User
 *
 * @apiHeaderExample {json} Request Header:
 *     {
 *       "Content-Type": "application/json"
 *     }
 *
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 * {
 *    {
 *         "id": 1,
 *         "username": "tpain2105",
 *         "email": "tpain2105@gmails.com",
 *         "deleted_at": null,
 *         "created_at": "2018-04-10 03:59:34",
 *         "updated_at": "2018-04-10 03:59:34"
 *     }
 * }
 *
 *
 *
 */
 $router->get('/{id}', ['middleware' => 'auth', 'uses' => 'UsersController@show', 'as' => 'show.user']);
 //

 /**
 * @api {post} api/v1/user Create a new User
 * @apiVersion 0.0.0
 * @apiPermission None
 * @apiName store.user
 * @apiGroup user
 *
 * @apiParam {String} username
 * @apiParam {String} email
 * @apiParam {String} password
 *
 * @apiHeaderExample {json} Request Header:
 *     {
 *       "Content-Type": "application/json"
 *     }
 *
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 * {
 *    {
 *         "id": 1,
 *         "username": "tpain2105",
 *         "email": "tpain2105@gmails.com",
 *         "created_at": "2018-04-10 03:59:34",
 *         "updated_at": "2018-04-10 03:59:34"
 *     }
 * }
 *
 *
 *
 */
 $router->post('/', ['middleware' => 'auth', 'uses' => 'UsersController@store', 'as' => 'store.user']);
 //

 /**
 * @api {put} api/v1/user/{id} Update a User
 * @apiVersion 0.0.0
 * @apiPermission None
 * @apiName update.user
 * @apiGroup user
 *
 * @apiParam {String} username
 * @apiParam {String} email
 *
 * @apiHeaderExample {json} Request Header:
 *     {
 *       "Content-Type": "application/json"
 *     }
 *
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 * {
 *    {
 *         "id": 1,
 *         "username": "tpain2108",
 *         "email": "tpain2108@gmails.com",
 *         "deleted_at": null,
 *         "created_at": "2018-04-10 03:59:34",
 *         "updated_at": "2018-04-10 03:59:34"
 *     }
 * }
 *
 *
 *
 */
 $router->put('/{id}', ['middleware' => 'auth', 'uses' => 'UsersController@update', 'as' => 'update.user']);
 //

 /**
 * @api {delete} api/v1/user/{id} Delete a User
 * @apiVersion 0.0.0
 * @apiPermission None
 * @apiName destroy.user
 * @apiGroup user
 *
 * @apiHeaderExample {json} Request Header:
 *     {
 *       "Content-Type": "application/json"
 *     }
 *
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 * {
 *    "User:tpain2011 Removed."
 * }
 *
 *
 *
 */
 $router->delete('/{id}', ['middleware' => 'auth', 'uses' => 'UsersController@destroy', 'as' => 'destroy.user']);
 //
