<?php

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

Route::resource('user', \App\Http\Controllers\UserController::class)
    ->except(['create', 'store', 'show'])
    ->middleware('auth');
Route::resource('user', \App\Http\Controllers\UserController::class)
    ->only(['create', 'store'])
    ->middleware(['auth', 'admin']);
Route::resource('cake', \App\Http\Controllers\CakesController::class)
    ->only(['create', 'update', 'store', 'edit'])
    ->middleware(['auth', 'designer']);
Route::resource('cake', \App\Http\Controllers\CakesController::class)
    ->only(['index'])
    ->middleware('auth');
Route::resource('cake', \App\Http\Controllers\CakesController::class)
    ->only('destroy')
    ->middleware(['auth', 'admin']);
Route::resource('component', \App\Http\Controllers\ComponentsController::class)
    ->only(['create', 'update', 'store', 'edit'])
    ->middleware(['auth', 'baker']);
Route::resource('component', \App\Http\Controllers\ComponentsController::class)
    ->only('index')
    ->middleware('auth');
Route::resource('component', \App\Http\Controllers\ComponentsController::class)
    ->only('destroy')
    ->middleware(['auth', 'designer']);

Route::resource('ingredient', \App\Http\Controllers\IngredientsController::class)
    ->except(['show'])
    ->middleware(['auth', 'baker']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
