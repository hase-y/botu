<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Controller;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



Route::get('/create', [Controller::class,'add'])->middleware('auth');
//Route::get('/create', 'App\Http\Controllers\Controller@add')->middleware('auth');
Route::post('/create', [Controller::class,'add'])->middleware('auth');
//Route::post('/create', 'App\Http\Controllers\Controller@add')->middleware('auth');
Route::get('/edit', 'App\Http\Controllers\Controller@edit')->middleware('auth');
//Route::post('create', 'ProfileController@create')->middleware('auth');
//Route::get('/home',[HomeController::class,'index']);

require __DIR__.'/auth.php';
