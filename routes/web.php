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

Route::group([], function() {
    session();
    Route::get('/', 'UserController@home');
    Route::get('home', 'UserController@home');
    Route::get('signin', 'UserController@signin');
    Route::get('signup', 'UserController@signup');
    Route::post('adduser', 'UserController@adduser');
    Route::post('authenticate', 'UserController@authenticate');
    Route::get('signout', 'UserController@signout');
    Route::get('confirm','UserController@confirm');
    Route::get('secret', 'UserController@secret');
    Route::post('secret/{numero}', 'UserController@secretn');
    Route::get('account','UserController@account');
    Route::get('mail','UserController@mailing');

    Route::prefix('forum')->middleware('myuser.auth')->group(function () {
        Route::get('categories', 'ForumController@categories');
        Route::get('category/{name}', 'ForumController@category');
        Route::get('newsubject', 'ForumController@newsubject');
        Route::post('createsubject', 'ForumController@createsubject');
        Route::get('category/{name}/{id}', 'ForumController@subject');
        Route::get('sendmessage', 'ForumController@sendmessage');
    });

    Route::prefix('outils')->group(function () {
        Route::get('categories', 'OutilController@categories');
        Route::get('category/{name}', 'OutilController@category');
    });
});

