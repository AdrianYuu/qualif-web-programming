<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
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

// Guest
Route::middleware('guest')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register_process', [UserController::class, 'register_process'])->name('register_process');
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login_process', [UserController::class, 'login_process'])->name('login_process');
});

// Authenticated
Route::middleware('auth')->group(function(){
    Route::get('/home', [ItemController::class, 'index'])->name('home');

    Route::get('/item_search', [ItemController::class, 'search'])->name('item_search');
    Route::get('/item_detail/{item_id}', [ItemController::class, 'detail'])->name('item_detail');
    
    Route::get('/profile/{user_id}', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile_edit/{user_id}', [ProfileController::class, 'edit'])->name('profile_edit');
    Route::patch('/profile_update/{user_id}', [ProfileController::class, 'update'])->name('profile_update');
    
    Route::get('/cart/{user_id}', [CartController::class, 'index'])->name('cart');
    Route::post('/cart_store/{item_id}', [CartController::class, 'store'])->name('cart_store');
    Route::get('/cart_delete/{item_id}', [CartController::class, 'delete'])->name('cart_delete');
    Route::delete('/cart_destroy/{item_id}', [CartController::class, 'destroy'])->name('cart_destroy');
    
    Route::get('/invoice_create/{user_id}', [InvoiceController::class, 'create'])->name('invoice_create');
    Route::post('/invoice_store/{user_id}', [InvoiceController::class, 'store'])->name('invoice_store');
    
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});

// Admin
Route::middleware(['auth', 'isAdmin'])->group(function(){
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category_create', [CategoryController::class, 'create'])->name('category_create');
    Route::post('/category_store', [CategoryController::class, 'store'])->name('category_store');
    Route::get('/category_edit/{category_id}', [CategoryController::class, 'edit'])->name('category_edit');
    Route::patch('/category_update/{category_id}', [CategoryController::class, 'update'])->name('category_update');
    
    Route::get('/item_create', [ItemController::class, 'create'])->name('item_create');
    Route::post('/item_store', [ItemController::class, 'store'])->name('item_store');
    Route::get('/item_edit/{item_id}', [ItemController::class, 'edit'])->name('item_edit');
    Route::patch('/item_update/{item_id}', [ItemController::class, 'update'])->name('item_update');
    Route::get('/item_delete/{item_id}', [ItemController::class, 'delete'])->name('item_delete');
    Route::delete('/item_destroy/{item_id}', [ItemController::class, 'destroy'])->name('item_destroy');

    Route::get('/invoice_list', [InvoiceController::class, 'index'])->name('invoice');
});
