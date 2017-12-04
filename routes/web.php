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

$router->get('api', 'PlayerController@show');
$router->get('api/v1/players', 'PlayerController@index');
$router->get('api/v1/players/{id}','PlayerController@getPlayer');
$router->post('api/v1/players','PlayerController@createPlayer');
$router->delete('api/v1/players/{id}','PlayerController@deletePlayer');
$router->post('api/v1/players/{id}','PlayerController@updatePlayer');

$router->get('api/v1/review', 'ReviewerController@index');
$router->get('api/v1/review/{id}','ReviewerController@getReview');
$router->post('api/v1/review','ReviewerController@createReview');
