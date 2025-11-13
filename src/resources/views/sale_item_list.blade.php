@extends('layouts.app_admin')

@section('title', '商品詳細')
@section('header_title', '登録商品詳細')

@section('content')
    @if ($item_title === "登録なし")
        <h2 style="color: #dc3545; text-align: center; margin-top: 50px;">
            🚨 エラー: 指定されたIDの商品は登録されていません。
        </h2>
        <p style="text-align: center;">URLを確認するか、管理画面から再度お試しください。</p>
    @else
        <h2 style="margin-top: 0;">{{ $item_title }}</h2>
        <hr>

        <div style="display: flex; gap: 30px; align-items: flex-start;">
            <div style="flex: 1; min-width: 300px; max-width: 40%;">
                @if ($item_image)
                    <img src="{{ asset('storage/' . $item_image) }}" alt="{{ $item_title }}" 
                         style="width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                @else
                    <div style="background-color: #eee; height: 300px; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #777;">
                        画像なし
                    </div>
                @endif
            </div>

            <div style="flex: 2;">
                <div style="background-color: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                    <h3 style="border-left: 4px solid #5a80a2; padding-left: 10px; margin-top: 0; color: #333;">価格情報</h3>
                    <div style="font-size: 2em; font-weight: bold; color: #28a745;">
                        開始価格: ¥{{ number_format($item_start_price) }}
                    </div>
                    <div style="margin-top: 15px; color: #777;">
                        終了期限: {{ optional($item_expired_date)->format('Y年m月d日 H:i:s') ?? '期限未設定' }}
                    </div>
                </div>

                <h3 style="border-left: 4px solid #5a80a2; padding-left: 10px; color: #333;">商品説明</h3>
                <div style="white-space: pre-wrap; background-color: #fff; padding: 15px; border: 1px solid #ddd; border-radius: 6px;">
                    {{ $item_description }}
                </div>
            </div>
        </div>

    @endif
@endsection