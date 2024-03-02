<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/', 'PostController@show')->name('post.show');
    Route::get('/read/{post}', 'PostController@read')->name('post.read');
    // Route::get('/', function(){
    //     return view('welcome');
    // });

    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        // Route::get('/users', function(){
        //     return view('dashboard.users');
        // })->name('users');

        Route::get('users', 'DashboardController@show')->name('users.show');
        Route::get('/users/create', 'DashboardController@create')->name('users.create');
        Route::post('/users/add', 'DashboardController@add')->name('users.add');
        Route::get('/users/{user}/edit', 'DashboardController@edit')->name('users.edit');
        Route::put('/users/{user}/update', 'DashboardController@update')->name('users.update');
        Route::delete('/users/{user}/delete', 'DashboardController@delete')->name('users.delete');

        Route::get('/post', 'PostController@index')->name('post.index');
        Route::get('/post/create', 'PostController@create')->name('post.create');
        Route::post('/post/add', 'PostController@add')->name('post.add');
        Route::get('/post/{post}/edit', 'PostController@edit')->name('post.edit');
        Route::put('/post/{post}/update', 'PostController@update')->name('post.update');
        Route::delete('/post/{post}/delete', 'PostController@delete')->name('post.delete');

    });
});