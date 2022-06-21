<?php

use App\Http\Controllers\BoardController;
use Illuminate\Support\Facades\Route;

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
Route::get('board/{board_identifier}', 'BoardController@singleBoardShow');
Route::put('/tasks/sync', 'TaskController@sync')->name('tasks.sync');
Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    //board
    Route::post('/store-board', 'BoardController@store')->name('store.board');
    Route::patch('/update-board/{board}', 'BoardController@update')->name('update.board');
    Route::delete('/delete-board/{board}', 'BoardController@delete')->name('delete.board');;

    //task

    Route::get('/task','TaskController@index')->name('task');
    Route::post('/store-task','TaskController@store')->name('store.task');
    Route::patch('/update-task/{task}','TaskController@update')->name('task.update');
    Route::delete('/delete/{task}','TaskController@delete')->name('delete.task');

    //Board frontend
    Route::get('/board', 'BoardController@show')->name('board.show');
});

