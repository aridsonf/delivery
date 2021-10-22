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


//Rotas user
Route::get('/dashboard', [ClientController::class, 'index'])->name('dashboard');
Route::get('/show_user', [ClientController::class, 'show'])->name('user.show');
Route::get('/list_users', [ClientController::class, 'listUsers'])->name('user.list');
Route::get('/create_users/create', [ClientController::class, 'create'])->name('user.create');
Route::post('/create_users', [ClientController::class, 'store'])->name('user.store');
Route::get('/edit_user/{id}', [ClientController::class, 'edit']);
Route::put('/update_users/{id}', [ClientController::class, 'update']);
Route::delete('/delete_user/{id}', [ClientController::class, 'destroy']);
