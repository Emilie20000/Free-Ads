<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\MessageController;


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

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/', [IndexController::class, 'showIndex'])->name('index');
Route::resource('users', UserController::class);

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authentificate'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/activate-account/{token}', [UserController::class, 'activateAccount'])->name('activate.account');

Route::resource('ads', AdController::class);

Route::post('/ads/search', [AdController::class, 'search'])->name('ads.search');

Route::resource('messages', MessageController::class);

Route::get('/messages/create/{userId}', [MessageController::class, 'create'])->name('messages.create');
