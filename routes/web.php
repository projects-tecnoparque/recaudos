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
    $roles = App\Models\Permission::query()->with('roles')->get();
    return response()->json(['data' => $roles]);
    return "<center>". config('app.name'). "</center>";
});

$router->get('/version', function () use ($router) {
    return $router->app->version();
});

$router->post('login', [
    'uses' => 'AuthController@login'
]);
$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->post('logout', 'AuthController@logout');
    $router->post('refresh', 'AuthController@refresh');
    $router->post('user-profile', 'AuthController@me');
});

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/document-types', 'DocumentTypeController@index');
    $router->post('/document-types', 'DocumentTypeController@store');
    $router->get('/document-types/{id}', 'DocumentTypeController@show');
    $router->put('/document-types/{id}', 'DocumentTypeController@update');
    $router->delete('/document-types/{id}', 'DocumentTypeController@destroy');
});

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/roles', 'RoleController@index');
    $router->get('/roles/{id}', 'RoleController@show');
});

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/permissions', 'PermissionController@index');
    $router->get('/permissions/{id}', 'PermissionController@show');
});


$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/users/{id}/relationships/document-type', fn() => 'TODO');
    $router->get('/users/{id}/document-type', fn() => 'TODO');
    $router->get('/users', 'UserController@index');
    $router->post('/users', 'UserController@store');
    $router->get('/users/{id}', 'UserController@show');
    $router->put('/users/{id}', 'UserController@update');
    $router->delete('/users/{id}', 'UserController@destroy');
});

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/customers', 'CustomerController@index');
    $router->get('/customers/{id}', 'CustomerController@show');
});


