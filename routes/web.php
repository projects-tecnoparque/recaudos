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
    return "<center>Recaudos</center>";
});

$router->get('/version', function () use ($router) {
    return $router->app->version();
});


$router->post('login', 'AuthController@login');
$router->post('logout', 'AuthController@logout');
$router->post('refresh', 'AuthController@refresh');
$router->post('user-profile', 'AuthController@me');

$router->get('/usuarios', 'UserController@index');
$router->get('/usuarios/{id}', 'UserController@show');

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/tipos-documentos', 'DocumentTypeController@index');
    $router->post('/tipos-documentos', 'DocumentTypeController@store');
    $router->get('/tipos-documentos/{id}', 'DocumentTypeController@show');
});

