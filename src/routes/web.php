<?php

use App\Http\Controllers\SaleItemController;
use App\Http\Controllers\SaleItemListController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('hello', 'App\Http\Controllers\HelloController@index');
// 登録商品一覧画面
Route::get('sale-items', [SaleItemListController::class, 'index'])->name('items.index');

// 商品詳細表示
Route::get('sale-item-list/{id}', 'App\Http\Controllers\SaleItemListController@show')->name('items.show_list');

// 商品登録フォーム表示
Route::get('/items/create', [SaleItemController::class, 'create'])->name('items.create');

// 商品登録処理
Route::post('/items', [SaleItemController::class, 'store'])->name('items.store');

// 商品説明の文字数チェック専用のAjaxルート
Route::post('/items/check-description', [SaleItemController::class, 'checkDescription'])->name('items.checkDescription');

// 管理画面（ダッシュボード）
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');