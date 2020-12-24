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
$api = app('Dingo\Api\Routing\Router');


$api->version('v1', [
    'middleware' => ['api.throttle'],
    'limit' => 100,
    'expires' => 5,
    'prefix' => 'api/v1',
    'namespace' => 'App\Http\Controllers\V1'
],
    function ($api) {
        $api->group(['middleware' => ['parseToken', 'api.auth']], function ($api) {
            //Posts protected routes
            $api->resource('posts', "PostController", [
                'except' => ['show', 'index']
            ]);

            //Comments protected routes
            $api->resource('comments', "CommentController", [
                'except' => ['show', 'index']
            ]);

            $api->post('posts/{id}/comments', 'CommentController@store');


            // Logout user by removing token
            $api->delete(
                '/', [
                    'uses' => 'Auth/AuthController@invalidateToken',
                    'as' => 'api.Auth.invalidate'
                ]
            );


            // Refresh token
            $api->patch(
                '/', [
                    'uses' => 'Auth/AuthController@refreshToken',
                    'as' => 'api.Auth.refresh'
                ]
            );
        });


        $api->get('posts', 'PostController@index');
        $api->get('posts/{id}', 'PostController@show');

        $api->get('posts/{id}/comments', 'CommentController@index');
        $api->get('comments/{id}', 'CommentController@show');


        $api->post(
            '/auth/login', [
                'as' => 'api.Auth.login',
                'uses' => 'Auth\AuthController@login',
            ]
        );



    });


$app->get('/', function () use ($app) {
    return $app->version();
});

