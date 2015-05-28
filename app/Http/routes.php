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

Blade::setRawTags('{{', '}}');

Route::get('/', 'WelcomeController@index');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'user', 'namespace' => 'User', 'middleware' => 'auth'], function()  
{
    Route::get('/', 'UserController@index');
    Route::get('home', 'UserController@index');
    Route::get('info', 'UserController@getInfo');
    Route::post('info', 'UserController@postInfo');

    Route::get('ad/create', 'AdController@create');
    Route::get('ad/waiting-list', 'AdController@getWaitingList');
    Route::get('ad/passed-list', 'AdController@getPassedList');
    Route::get('ad/rejected-list', 'AdController@getRejectedList');
    Route::resource('ad', 'AdController');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function()  
{
    Route::get('/', 'AdminController@index');
    Route::get('home', 'AdminController@index');
    Route::get('info', 'AdminController@getInfo');

    Route::get('ad/waiting-list', 'AdController@getWaitingList');
    Route::get('ad/passed-list', 'AdController@getPassedList');
    Route::get('ad/rejected-list', 'AdController@getRejectedList');
    Route::get('ad/{id}/pass', 'AdController@getPass');
    Route::get('ad/{id}/reject', 'AdController@getReject');
    Route::resource('ad', 'AdController');
});
