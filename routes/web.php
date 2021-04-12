<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;

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
    Route::get('/home', [AdminController::class, 'index'])->name('admin.home');

    Route::get('/', [LoginController::class, 'showAdminLogin'])->name('admin.login.form');
    Route::get('/login', [LoginController::class, 'showAdminLogin'])->name('admin.login.form');
    Route::post('/login', [LoginController::class, 'adminLogin'])->name('admin.login');
    
    Route::post('/logout', [LoginController::class, 'adminLogout'])->name('admin.logout');

    Route::get('/register', [RegisterController::class, 'showAdminRegister'])->name('admin.register.form');
    Route::post('/register', [RegisterController::class, 'adminRegister'])->name('admin.register');

    Route::prefix('category')->group(function (){
        Route::get('/', [CategoryController::class, 'fetchAll'])->name('category.fetchAll');
        Route::post('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::put('/update', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    });

    Route::prefix('product')->group(function (){
        Route::get('/', [ProductController::class, 'fetchAll'])->name('product.fetchAll');
        Route::get('/add', [ProductController::class, 'add'])->name('product.add');
        Route::post('/create', [ProductController::class, 'create'])->name('product.create');
        Route::put('/update', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
        Route::get('/fetch/{id}', [ProductController::class, 'fetchById'])->name('product.byId');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    })
});
