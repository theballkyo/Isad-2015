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

Route::get('/', 'HomeController@index');

Route::group(['middleware' => ['web']], function () {

    Route::group(['middleware' => ['auth']], function() {
        //  Route::get('');
    });

    Route::group(['middleware' => ['auth'], 'namespace' => 'Admin'], function () {
        Route::get('/admin', 'AdminController@index');
    });

});

Route::auth();

Route::get('/home', 'HomeController@index');
