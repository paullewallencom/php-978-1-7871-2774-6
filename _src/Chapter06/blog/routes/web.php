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

function resource($uri, $controller, $except = [])
{
    //$verbs = ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE'];

    global $app;


    if(!in_array('index', $except)){
        $app->get($uri, $controller.'@index');
    }

    if(!in_array('store', $except)) {
        $app->post($uri, $controller . '@store');
    }

    if(!in_array('show', $except)) {
        $app->get($uri . '/{id}', $controller . '@show');
    };

    if(!in_array('udpate', $except)) {
        $app->put($uri . '/{id}', $controller . '@update');
        $app->patch($uri . '/{id}', $controller . '@update');
    }

    if(!in_array('destroy', $except)) {
        $app->delete($uri . '/{id}', $controller . '@destroy');
    }
}


$app->get('/', function () use ($app) {
    return $app->version();
});


resource('api/posts', 'PostController');

resource('api/comments', 'CommentController', ['store','index']);

$app->post('api/posts/{id}/comments', 'CommentController@store');
$app->get('api/posts/{id}/comments', 'CommentController@index');


