<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProductController,
    LoginController,
    ClientController
};


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

Route::resource('/crud_products', ProductController::class);

//Login rotas
Route::get('/login', [LoginController::class, 'login'])->name('login.delivery');
Route::get('/auth', [LoginController::class, 'auth'])->name('auth.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');


//Rotas client
Route::get('/dashboard', [ClientController::class, 'index'])->name('dashboard');
