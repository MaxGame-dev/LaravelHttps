// resources/views/sale_item_list_index.blade.php
@extends('layouts.app_admin')

@section('title', '登録商品一覧')
@section('header_title', '登録商品一覧')

@section('content')
    <h2 style="margin-top: 0;">現在登録されている商品一覧</h2>
    
    @if ($items->isEmpty())
        <div style="background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; padding: 15px; border-radius: 6px; text-align: center;">
            現在、登録されている商品はありません。
        </div>
    @else
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background-color: #f0f4f8;">
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">ID</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">商品タイトル</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">開始価格</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">期限</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr style="background-color: {{ $loop->even ? '#f9f9f9' : 'white' }};">
                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $item->id }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $item->item_title }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">¥{{ number_format($item->start_price) }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">
                        {{ optional($item->expired_date)->format('Y/m/d H:i') ?? 'N/A' }}
                    </td>
                    <td style="padding: 12px; border: 1px solid #ddd; text-align: center;">
                        <a href="{{ route('items.show_list', ['id' => $item->id]) }}" 
                           style="color: #5a80a2; text-decoration: none; font-weight: bold;">
                           詳細
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection