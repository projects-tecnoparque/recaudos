<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('test_route', [
    // 'middleware' => 'validate-headers-json',
    'uses' => 'UserController@index'
]);

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/usuarios', 'UserController@index');
$router->get('/usuarios/{id}', 'UserController@show');

$router->get('/tipos-documentos', 'DocumentTypeController@index');
$router->post('/tipos-documentos', [
    // 'middleware' => 'validate-headers-json',
    'uses' => 'DocumentTypeController@store'
]);
$router->get('/tipos-documentos/{id}', 'DocumentTypeController@show');
