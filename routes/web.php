<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProductController,
    LoginController,
    ClientController,
    DeliveryController
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

//Rotas delivery request
Route::get('/list_request', [DeliveryController::class, 'index'])->name('request.list');
Route::get('/show_request/{id}', [DeliveryController::class, 'show']);
Route::get('/create_request/create', [DeliveryController::class, 'createDelivery'])->name('request.create');
Route::post('/create_request', [DeliveryController::class, 'store'])->name('request.store');
Route::get('/shopping_request', [DeliveryController::class, 'shopping'])->name('request.shopping');
Route::post('/shopping_request', [DeliveryController::class, 'storeRequestData'])->name('request.product.store');
