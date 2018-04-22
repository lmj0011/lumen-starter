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
 * @api {post} api/v1/auth/login Log into the app
 * @apiVersion 0.0.0
 * @apiPermission None
 * @apiName auth.login
 * @apiGroup auth
 *
 * @apiParam {String} username
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
 *      {
 *        "access_token": "XXXXXXXXXX",
 *        "token_type": "bearer",
 *        "expires_in": 3600
 *      }
 * }
 *
 *
 *
 */
$router->post('/login', ['uses' => 'AuthController@login', 'as' => 'auth.login']);
//

/**
* @api {post} api/v1/auth/logout Log out of the app
* @apiVersion 0.0.0
* @apiPermission Auth
* @apiName auth.logout
* @apiGroup auth
*
* @apiHeaderExample {json} Request Header:
*     {
*       "Content-Type": "application/json",
*       "Authorization": "Bearer <your-token>"
*     }
*
* @apiSuccessExample {json} Success-Response:
*     HTTP/1.1 200 OK
* {
*    [
*         {
*             "message": "Successfully logged out"
*         }
*		]
* }
*
*
*
*/
$router->post('/logout', ['middleware' => 'auth', 'uses' => 'AuthController@logout', 'as' => 'auth.logout']);
//


/**
* @api {post} api/v1/auth/me Get your User data
* @apiVersion 0.0.0
* @apiPermission Auth
* @apiName auth.me
* @apiGroup auth
*
* @apiHeaderExample {json} Request Header:
*     {
*       "Content-Type": "application/json",
*       "Authorization": "Bearer <your-token>"
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
$router->post('/me', ['middleware' => 'auth', 'uses' => 'AuthController@me', 'as' => 'auth.me']);
//


/**
* @api {post} api/v1/auth/refresh Refresh your api token
* @apiVersion 0.0.0
* @apiPermission Auth
* @apiName auth.refresh
* @apiGroup auth
*
* @apiHeaderExample {json} Request Header:
*     {
*       "Content-Type": "application/json",
*       "Authorization": "Bearer <your-token>"
*     }
*
* @apiSuccessExample {json} Success-Response:
*     HTTP/1.1 200 OK
* {
*      {
*        "access_token": "XXXXXXXXXX",
*        "token_type": "bearer",
*        "expires_in": 3600
*      }
* }
*
*
*
*/
$router->post('/refresh', ['middleware' => 'auth', 'uses' => 'AuthController@refresh', 'as' => 'auth.refresh']);
//
