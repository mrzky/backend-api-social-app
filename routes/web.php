<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

// $router->get('/', 'UserLoginController@index');
// $router->get('/userLogins','UserLoginController@showUserLogins');
// $router->post('/addUser','UserLoginController@submitUser');