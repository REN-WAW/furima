<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;




Route::get('/', [ItemController::class, 'index'] )->name('index');

Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('item.show');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.perform');


Route::middleware('auth')->group(function () {
    Route::get('/mypage', [UserController::class, 'show'])->name('mypage.show');
    Route::get('/mypage/profile', [UserController::class, 'edit'])->name('mypage.edit');
    Route::post('/mypage/profile', [UserController::class, 'update'])->name('mypage.update');

    Route::get('/sell', [ItemController::class, 'create'])->name('sell.create');
    Route::post('/sell', [ItemController::class, 'store'])->name('sell.store');

    Route::post('/item/{item_id}/like', [LikeController::class, 'toggle'])->name('item.like');
    Route::post('/item/{item_id}/comments', [LikeController::class, 'store'])->name('item.comments.store');

    Route::get('/purchase/{item}', [PurchaseController::class, 'showPurchaseForm'])->name('purchase');
    Route::post('/purchase/{item}/store', [PurchaseController::class, 'store'])->name('purchase.store');
});

Route::get('/purchase/address/{item_id}', [UserController::class, 'edit'])->name('address.edit');