<?php

use App\Http\Controllers\RedisController;
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

    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {

        Route::get('/dashboard', 'DashboardController@summary')->middleware('admin')->name('dashboard');

        Route::get('users', 'DashboardController@show')->middleware('admin')->name('users.show');
        Route::get('/users/create', 'DashboardController@create')->middleware('admin')->name('users.create');
        Route::post('/users/add', 'DashboardController@add')->middleware('admin')->name('users.add');
        Route::get('/users/{user}/edit', 'DashboardController@edit')->middleware('admin')->name('users.edit');
        Route::put('/users/{user}/update', 'DashboardController@update')->middleware('admin')->name('users.update');
        Route::delete('/users/{user}/delete', 'DashboardController@delete')->middleware('admin')->name('users.delete');
        Route::get('/users/remind/all', 'DashboardController@remind')->middleware('admin')->name('users.remind');

        Route::get('/post', 'PostController@index')->name('post.index');
        Route::get('/post/create', 'PostController@create')->name('post.create');
        Route::post('/post/add', 'PostController@add')->name('post.add');
        Route::get('/post/{post}/edit', 'PostController@edit')->name('post.edit');
        Route::put('/post/{post}/update', 'PostController@update')->name('post.update');
        Route::delete('/post/{post}/delete', 'PostController@delete')->name('post.delete');


        Route::get('/redis', 'RedisController@search')->name('redis.search');
        Route::get('/redis/add', 'RedisController@addForm')->name('redis.form');
        Route::get('/redis/search', 'RedisController@show')->name('redis.show');
        Route::post('/redis/create', 'RedisController@add')->name('redis.add');

    });
});