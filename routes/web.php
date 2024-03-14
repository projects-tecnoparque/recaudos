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

$router->get('/', function () use ($router) {
    return "<center>". config('app.name'). "</center>";
});

$router->get('/version', function () use ($router) {
    return $router->app->version();
});

$router->post('login', [
    // 'middleware' => 'header-json',
    'uses' => 'AuthController@login'
]);
$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->post('logout', 'AuthController@logout');
    $router->post('refresh', 'AuthController@refresh');
    $router->post('user-profile', 'AuthController@me');
});

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/usuarios', 'UserController@index');
    $router->post('/usuarios', 'UserController@store');
    $router->get('/usuarios/{id}', 'UserController@show');
    $router->put('/usuarios/{id}', 'UserController@update');
    $router->delete('/usuarios/{id}', 'UserController@destroy');
});

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/tipos-documentos', 'DocumentTypeController@index');
    $router->post('/tipos-documentos', 'DocumentTypeController@store');
    $router->get('/tipos-documentos/{id}', 'DocumentTypeController@show');
    $router->put('/tipos-documentos/{id}', 'DocumentTypeController@update');
    $router->delete('/tipos-documentos/{id}', 'DocumentTypeController@destroy');
});

