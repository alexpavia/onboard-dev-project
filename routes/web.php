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
// Home Routes
Route::get('/home', 'HomeController@index')->name('home');

// Task Routes
Route::get('/tasks', 'TasksController@index')->name('tasks');
Route::get('/task/{taskId}', ['as' => 'taskId', 'uses' => 'TasksController@loadTask'])->name('task');
Route::get('/task/edit/{taskId}', ['as' => 'taskId', 'uses' => 'TasksController@edit'])->name('task-edit');

Route::post('/task/edit/{taskId?}', 'TasksController@updateTask');
Route::post('/tasks', 'TasksController@store');



