<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\JobController;

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
$router->post('job', [
    'as' => 'store', 'uses' => 'JobController@store'
]);
$router->get('job/{reference}', [
    'as' => 'show', 'uses' => 'JobController@show'
]);
$router->put('job/{reference}', [
    'as' => 'remove', 'uses' => 'JobController@update'
]);
$router->delete('job/{reference}', [
    'as' => 'remove', 'uses' => 'JobController@remove'
]);
