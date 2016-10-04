<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('test','Paises@index');
Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'AngularController@serveApp');

    Route::get('/unsupported-browser', 'AngularController@unsupported');
});

//public API routes
$api->group(['middleware' => ['api']], function ($api) {

    // Authentication Routes...
    $api->post('auth/login', 'Auth\AuthController@login');
    $api->post('auth/register', 'Auth\AuthController@register');

    // Password Reset Routes...
    $api->post('auth/password/email', 'Auth\PasswordResetController@sendResetLinkEmail');
    $api->get('auth/password/verify', 'Auth\PasswordResetController@verify');
    $api->post('auth/password/reset', 'Auth\PasswordResetController@reset');

    /*$api->get('categorias','Categorias@index');
    $api->get('categorias/{id}','Categorias@show');
    $api->post('categorias','Categorias@store');
    */
    $api->resource('categorias','Categorias',[
        'only'=>['index','show','store']
    ]);
    $api->post('categorias/{id}','Categorias@update');
    $api->delete('categorias/{id}/delete','Categorias@destroy');

    $api->resource('actividades','Actividades',[
        'only'=>['index','show','store']
    ]);
    $api->post('actividades/{id}','Actividades@update');
    $api->delete('actividades/{id}/delete','Actividades@destroy');

    $api->resource('tips','Tips',[
        'only'=>['index','show','store']
    ]);
    $api->post('tips/{id}','Tips@update');
    $api->delete('tips/{id}/delete','Tips@destroy');

    $api->resource('items','Items',[
        'except' => ['update','destroy']
    ]);
    $api->post('items/{id}','Items@update');
    $api->delete('items/{id}/delete','Items@destroy');

    $api->get('paises','Paises@index');

});

//protected API routes with JWT (must be logged in)
$api->group(['middleware' => ['api', 'api.auth']], function ($api) {

});
