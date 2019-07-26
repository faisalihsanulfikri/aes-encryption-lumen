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

$router->post('/kriptografi', 'KriptografiController@kriptografi');
$router->post('/kriptografi/enkripsi', 'KriptografiController@enkripsi');
$router->post('/kriptografi/dekripsi', 'KriptografiController@dekripsi');
