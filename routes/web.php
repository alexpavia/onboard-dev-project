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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/tasks', 'TasksController@index')->name('tasks');
Route::get('/task/{taskId}', function($taskId) {
    $task = \App\Task::where('id', $taskId)->first(); // Should this be handled in the controller?  If so, how do I specify controller when passing a param?
    return view('tasks.task', [
        'task' => $task
    ]);
})->name('task');
