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
//Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/', ['uses' => 'Controller@login']);
Route::post('/login', ['as' => 'user.login', 'uses' => 'DashboardController@auth']);
Route::get('/dashboard', ['as' => 'user.dashboard', 'uses' => 'DashboardController@index']);
Route::get('/types', ['as' => 'type.index', 'uses' => 'TypesController@index']);
Route::get('/pending', ['as' => 'pending.index', 'uses' => 'RequestsController@pending']);
Route::get('/aproved', ['as' => 'aproved.index', 'uses' => 'RequestsController@aproved']);
Route::resource('user', 'UsersControler');