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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::put('post/{id}', function($id){

})->middleware('auth', 'role:admin');

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/addVideo', [App\Http\Controllers\VideoController::class, 'index'])->name('addVideo');
Route::post('/addVideo', [App\Http\Controllers\VideoController::class, 'create'])->name('load');
//Route::get('/viewVideo',[App\Http\Controllers\VideoController::class, 'show'] )->name('viewVideo');
Route::get('/Video/{id}', [\App\Http\Controllers\VideoController::class, 'show'])->name('viewVideo/');
Route::get('/borrando/{id}', [\App\Http\Controllers\VideoController::class, 'delete'])->name('delete/');
Route::get('/perfil', [App\Http\Controllers\UserController::class, 'index'])->name('profile');
Route::get('/adminu', [App\Http\Controllers\UserController::class, 'adminUsers'])->name('adminUsers');
Route::get('/adminv', [App\Http\Controllers\UserController::class, 'adminVideos'])->name('adminVideos');
Route::get('/deleteUser/{id}', [App\Http\Controllers\UserController::class, 'dropUser'])->name('dropUser/');
Route::get('/deleteVideo/{id}', [App\Http\Controllers\UserController::class, 'dropVideo'])->name('dropVideo/');
Route::post('/modifyUser', [App\Http\Controllers\UserController::class, 'updateUser'])->name('modify');

