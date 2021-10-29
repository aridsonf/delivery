<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProductController,
    LoginController,
    UserController,
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
Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
Route::get('/show_user', [UserController::class, 'show'])->name('user.show');
Route::get('/list_users', [UserController::class, 'listUsers'])->name('user.list');
Route::get('/create_users/create', [UserController::class, 'create'])->name('user.create');
Route::post('/create_users', [UserController::class, 'store'])->name('user.store');
Route::get('/edit_user/{id}', [UserController::class, 'edit']);
Route::put('/update_users/{id}', [UserController::class, 'update']);
Route::delete('/delete_user/{id}', [UserController::class, 'destroy']);

//Rotas delivery request
Route::get('/list_request', [DeliveryController::class, 'index'])->name('request.list');
Route::get('/show_request/{id}', [DeliveryController::class, 'showDeliverys']);
Route::get('/show_request', [DeliveryController::class, 'showUserDelivery'])->name('request.show');
Route::get('/shopping_request', [DeliveryController::class, 'shopping'])->name('request.shopping');
Route::post('/shopping_request', [DeliveryController::class, 'storeRequestData'])->name('request.product.store');
Route::get('/edit_request/{id}', [DeliveryController::class, 'editShopping'])->name('request.shopping.edit');
Route::put('/update_request/{id}', [DeliveryController::class, 'updateRequestData']);
Route::put('/update_request_delivered/{id}', [DeliveryController::class, 'updateRequestDataDelivered']);
Route::delete('/delete_request/{id}', [DeliveryController::class, 'destroyRequestData']);
Route::put('/create_delivery', [DeliveryController::class, 'storeDelivery'])->name('delivery.create');
Route::put('/update_delivery/{id}', [DeliveryController::class, 'updateDeliveryStatus']);
Route::delete('/delete_delivery/{id}', [DeliveryController::class, 'destroyDelivery']);
Route::get('/create_delivery_pdf/{id}', [DeliveryController::class, 'createPDF']);
