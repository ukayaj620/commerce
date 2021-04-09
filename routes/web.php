<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function (){
    Route::get('/', function () {
        return view('admin.welcome');
    })->name('admin.index');

    Route::get('/home', [AdminController::class, 'index'])->name('admin.home');

    Route::get('/login', [LoginController::class, 'showAdminLogin'])->name('admin.login.form');
    Route::post('/login', [LoginController::class, 'adminLogin'])->name('admin.login');
    
    Route::post('/logout', [LoginController::class, 'adminLogout'])->name('admin.logout');

    Route::get('/register', [RegisterController::class, 'showAdminRegister'])->name('admin.register.form');
    Route::post('/register', [RegisterController::class, 'adminRegister'])->name('admin.register');
});
