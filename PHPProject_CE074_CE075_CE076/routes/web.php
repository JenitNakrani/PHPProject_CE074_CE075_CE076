<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::get('laravel/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', function () {
    return view('home');
});

Route::view('myregister', 'myregister');
Route::POST('register', [UserController::class,'addMember']);

Route::view('mylogin', 'mylogin');
Route::POST('userlogin', [UserController::class,'loginMember']);
Route::view('login_welcome', 'login_welcome');

Route::view('about/', 'about');
Route::get('/logout',[UserController::class,'logoutMember']);

Route::view('addbook','addbook');
Route::POST('addbook',[UserController::class,'addBook']);

Route::GET('removebook',[UserController::class,'removeBook']);
Route::POST('removebook',[UserController::class,'removeBook']);