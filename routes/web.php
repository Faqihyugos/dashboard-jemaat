<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JemaatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;

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
    return view('auth.login');
});

Auth::routes();

// Remove register

Route::match(["GET", "POST"], "/register", function(){
    return redirect("/login");
})->name("register");

// -----------------------------login-----------------------------------------
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ----------------------------- akun Management ------------------------------
Route::resource('user', UserController::class);
Route::put('user/{user}/updatePassword', [UserController::class, 'updatePassword'])->name('user.updatePassword');
Route::get('user/{user}/editPassword/', [UserController::class, 'editPassword'])->name('user.editPassword');
Route::get('activity/log', [UserController::class, 'activityLog'])->name('activity/log');
Route::get('activity/login/logout', [UserController::class, 'activityLogInLogOut'])->name('activity/login/logout');

// ----------------------------- jemaat Management ------------------------------
Route::resource('jemaat', JemaatController::class);
Route::post('jemaat/store', [JemaatController::class, 'store'])->name('jemaat.store');
// ----------------------------- search jemaat Management ------------------------------
Route::post('jemaat', [JemaatController::class, 'search'])->name('search');




