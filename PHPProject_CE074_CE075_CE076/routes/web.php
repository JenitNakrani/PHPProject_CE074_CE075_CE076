<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;

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
	return view('login_welcome');
});

Route::GET('/', [UserController::class,'home']);

Route::view('myregister', 'myregister');
Route::POST('register', [UserController::class,'addMember']);

Route::GET('mylogin', [UserController::class,'loginMember']);
Route::POST('userlogin', [UserController::class,'loginMember']);
Route::view('login_welcome', 'login_welcome');

Route::view('about/', 'about');
Route::get('/logout',[UserController::class,'logoutMember']);

Route::GET('addbook',[BookController::class,'addBook']);
Route::POST('addbook',[BookController::class,'addBook']);

Route::GET('removebook',[BookController::class,'removeBook']);
Route::POST('removebook',[BookController::class,'removeBook']);

Route::GET('issuebook',[BookController::class,'issueBook']);
Route::POST('issuebook',[BookController::class,'issueBook']);

Route::GET('returnbook',[BookController::class,'returnBook']);
Route::POST('returnbook',[BookController::class,'returnBook']);

Route::view('adminlogin','adminlogin');
Route::POST('adminlogin', [UserController::class,'adminLogin']);
Route::view('admin_welcome', 'admin_welcome');