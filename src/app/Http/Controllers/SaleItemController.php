<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleItemList; // モデルをインポート
use Illuminate\Support\Facades\Auth; // 認証情報を利用する場合

class SaleItemController extends Controller
{
    /**
     * 出品商品登録フォームの表示
     */
    public function create()
    {
        return view('sale_items.create');
    }

    /**
     * 出品商品の登録処理
     */
    public function store(Request $request)
    {
        // 1. バリデーション（必須）
        $validated = $request->validate([
            'item_title'       => 'required|max:255',
            'item_description' => 'required',
            'start_price'      => 'required|integer|min:1',
            'expired_date'     => 'required|date|after:now',
        ]);

        // 2. データの保存
        $item = new SaleItemList();
        // ログインユーザーのIDを sale_user_id に設定
        // 実際には Auth::id() などを使って認証ユーザーIDを設定します。
        // ここでは仮に '1' としています。
        // $item->sale_user_id = Auth::id(); 
        $item->sale_user_id = 1; 
        
        $item->item_title = $validated['item_title'];
        $item->item_description = $validated['item_description'];
        $item->start_price = $validated['start_price'];
        $item->expired_date = $validated['expired_date'];
        
        $item->save();
        
        // または、一括代入（fill/create）を使用する場合
        /*
        SaleItemList::create([
            'sale_user_id' => Auth::id() ?? 1, // 認証ユーザーID
            'item_title' => $validated['item_title'],
            'item_description' => $validated['item_description'],
            'start_price' => $validated['start_price'],
            'expired_date' => $validated['expired_date'],
        ]);
        */


        // 3. リダイレクト
        return redirect()->route('items.create')->with('success', '商品を出品しました！');
        // または、登録後の商品詳細ページなどにリダイレクト
        // return redirect()->route('items.show', $item->id)->with('success', '商品を出品しました！');
    }
}