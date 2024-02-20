<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/tasks', 'App\Http\Controllers\TaskController@store');

Route::put('/tasks/{task}', 'App\Http\Controllers\TaskController@update');
Route::delete('/tasks/{task}', 'App\Http\Controllers\TaskController@destroy');

Route::post('/administrators', 'App\Http\Controllers\AdministratorController@store');
Route::post('/users', 'App\Http\Controllers\UserController@store');

Route::group(['middleware' => 'auth:admin'], function () {
    // Admin routes
});


