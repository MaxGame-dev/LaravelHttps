<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleItemList; // モデルをインポート
use Illuminate\Support\Facades\Auth; // 認証情報を利用する場合
use Illuminate\Support\Facades\Storage; // ★ Storageファサードをインポート

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
        // 1. バリデーション
        $validated = $request->validate([
            'item_title'       => 'required|max:255',
            'item_description' => 'required',
            'item_image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 最大2MB
            'start_price'      => 'required|integer|min:1',
            'expired_date'     => 'required|date|after:now',
        ]);

        $image_path = null;

        // 2. ファイルのアップロード処理
        if ($request->hasFile('item_image')) {
            // 'public/items' ディレクトリに画像を保存し、ファイル名を取得
            // LaravelのStorageファサードを使うと、ファイルシステム操作が簡単になります。
            // 'public'ディスクは、storage/app/public に対応します。
            $image_path = $request->file('item_image')->store('items', 'public');
            // $image_path には、'items/ランダムなファイル名.jpg' のようなパスが格納されます。
        }

        // 3. データの保存 (createメソッドで一括保存)
        $item = SaleItemList::create([
            'sale_user_id'     => Auth::id() ?? 1, // ユーザーIDは適切に設定
            'item_title'       => $validated['item_title'],
            'item_description' => $validated['item_description'],
            'item_image'       => $image_path, // 保存したファイルパス/名をDBに格納
            'start_price'      => $validated['start_price'],
            'expired_date'     => $validated['expired_date'],
        ]);

        // 4. リダイレクト
        return redirect()->route('items.create')->with('success', '商品を出品しました！');
    }
}