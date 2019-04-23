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

// INDEX PAGE
Route::get('/', function () {
    return view('index');
});

// PREVENT BACK BUTTON AFTER LOGOUT
Route::group(['middleware' => 'revalidate'], function(){
    // Auth
    Auth::routes();

    // REDIRECT AFTER LOGIN
    Route::get('/home', 'HomeController@index')->name('home');

    // POST CONTROLLER
    Route::resource('/post', 'PostController');

    // USER REACT CONTROLLER
    Route::resource('/react', 'UserReactController');

    // COMMENT CONTROLLER
    Route::resource('/comment', 'CommentController');

    //ADMIN CONTROLLER
    Route::resource('/admin', 'AdminController');
});

