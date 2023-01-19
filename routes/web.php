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

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
	Route::resource('projects', 'ProjectsController');
 	Route::resource('tasks', 'TasksController');
});

Route::get('/search', 'SearchController@index')->middleware('auth');

Route::get('/admin', 'AdminController@index')->middleware('auth', 'isAdmin');
Route::get('/admin/tasks', 'AdminController@tasks')->middleware('auth', 'isAdmin');
Route::get('/admin/users', 'AdminController@users')->middleware('auth', 'isAdmin');
Route::delete('/admin/destroy/{user}', 'AdminController@destroy')->middleware('auth', 'isAdmin');