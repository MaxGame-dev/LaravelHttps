<?php

use App\Http\Controllers\SaleItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('hello', 'App\Http\Controllers\HelloController@index');
Route::get('sale-item-list/{id}', 'App\Http\Controllers\SaleItemListController@show');

// 商品登録フォーム表示
Route::get('/items/create', [SaleItemController::class, 'create'])->name('items.create');

// 商品登録処理
Route::post('/items', [SaleItemController::class, 'store'])->name('items.store');

// 商品説明の文字数チェック専用のAjaxルート
Route::post('/items/check-description', [SaleItemController::class, 'checkDescription'])->name('items.checkDescription');