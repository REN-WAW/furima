<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;




//商品一覧画面(トップ画面）
Route::get('/', [ItemController::class, 'index'] )->name('index');

//商品詳細画面
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('item.show');

//ログイン
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');

//会員登録
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.perform');


//マイページ
Route::middleware('auth')->group(function () {
    Route::get('/mypage', [UserController::class, 'show'])->name('mypage.show');
    Route::get('/mypage/profile', [UserController::class, 'edit'])->name('mypage.edit');
    Route::post('/mypage/profile', [UserController::class, 'update'])->name('mypage.update');

//出品画面
    Route::get('/sell', [ItemController::class, 'create'])->name('sell.create');
    Route::post('/sell', [ItemController::class, 'store'])->name('sell.store');
    
    Route::post('/item/{item_id}/like', [LikeController::class, 'toggle'])->name('item.like');
    Route::post('/item/{item_id}/comments', [LikeController::class, 'store'])->name('item.comments.store');

    Route::get('/purchase/{item_id}', [PurchaseController::class, 'create'])->name('purchase.create');
    Route::post('/purchase/{item_id}', [PurchaseController::class, 'store'])->name('purchase.store');
});

Route::get('/purchase/address/{item_id}', [UserController::class, 'edit'])->name('address.edit');