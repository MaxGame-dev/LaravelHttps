@extends('layouts.app_admin')

@section('title', '商品管理ダッシュボード')
@section('header_title', '商品管理ダッシュボード')

@section('content')
    <h2 style="margin-top: 0;">各機能へのアクセス</h2>
    
    <hr>

    <div class="menu-item">
        <h3>1. 商品登録</h3>
        <p>新しい商品を出品するためのフォームへ移動します。</p>
        <a href="{{ route('items.create') }}" class="button-primary">
            📦 商品登録画面へ
        </a>
    </div>

    <hr>

    <div class="menu-item">
        <h3>2. 登録商品表示</h3>
        <p>登録されている全商品の一覧へ移動し、詳細を確認します。</p>
        <a href="{{ route('items.index') }}" class="button-primary">
            📋 登録商品一覧画面へ
        </a>
    </div>
@endsection