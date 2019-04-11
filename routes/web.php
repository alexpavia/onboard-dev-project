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

Route::patch('/task/edit/{taskId?}', 'TasksController@updateTask');
Route::post('/task/new', 'TasksController@store');
Route::delete('/task/delete/{taskId}', 'TasksController@destroy');

// Note Routes
Route::get('/note/edit/{noteId}', ['as' => 'noteId', 'uses' => 'NotesController@loadNote'])->name('note');
Route::get('/note/create/{taskId}', ['as' => 'taskId', 'uses' => 'NotesController@create']);

Route::patch('/note/edit/{noteId}', 'NotesController@updateNote');
Route::post('/note/new', 'NotesController@store');
Route::delete('/note/delete/{noteId}', 'NotesController@destroy');

