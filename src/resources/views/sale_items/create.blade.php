@extends('layouts.app_admin')

@section('title', '商品登録')
@section('header_title', '商品登録フォーム')

@section('content')
    <h2 style="margin-top: 0;">新規出品商品の登録</h2>
    
    @if (session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert" style="background-color: #f8d7da; color: #721c24; border-color: #f5c6cb;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="item_title">商品タイトル <span style="color: red;">*</span></label>
            <input type="text" id="item_title" name="item_title" value="{{ old('item_title') }}" required>
            @error('item_title')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="item_description">商品説明 <span style="color: red;">*</span></label>
            <textarea id="item_description" name="item_description" rows="5" required>{{ old('item_description') }}</textarea>
            <p id="char-count" style="font-size: 0.9em; margin-top: 5px;">現在 0 / 30 文字</p>
            <p id="ajax-validation-status" class="error-message" style="margin-top: 5px;"></p>
            @error('item_description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="item_image">商品画像 (JPEG, PNG, GIF, 最大2MB)</label>
            <input type="file" id="item_image" name="item_image" accept="image/jpeg,image/png,image/gif">
            @error('item_image')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="start_price">開始価格 (円) <span style="color: red;">*</span></label>
            <input type="number" id="start_price" name="start_price" 
                value="{{ old('start_price') }}" 
                min="1" 
                max="2147483647"  required>
            @error('start_price')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="expired_date">終了期限 <span style="color: red;">*</span></label>
            <input type="datetime-local" id="expired_date" name="expired_date" value="{{ old('expired_date') }}" required>
            @error('expired_date')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        
        <div style="text-align: right; margin-top: 30px;">
            <button type="submit" class="button-primary">
                ⬆️ この商品を出品する
            </button>
        </div>
    </form>
@endsection

{{-- Ajaxチェック用のJavaScriptを追記 --}}
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const textarea = document.getElementById('item_description');
        const charCount = document.getElementById('char-count');
        const ajaxStatus = document.getElementById('ajax-validation-status');
        const maxLength = 30;

        // ページロード時に文字数を初期表示
        charCount.textContent = `現在 ${textarea.value.length} / ${maxLength} 文字`;

        textarea.addEventListener('input', function() {
            const currentLength = this.value.length;
            
            // 1. リアルタイム文字数表示とスタイル変更
            charCount.textContent = `現在 ${currentLength} / ${maxLength} 文字`;
            
            if (currentLength > maxLength) {
                const overCount = currentLength - maxLength;
                charCount.textContent = `超過: ${overCount} 文字 (${currentLength} / ${maxLength})`;
                charCount.style.color = 'red';
            } else {
                charCount.style.color = '#777'; // 通常の色
            }
            
            // 2. Ajaxチェックを実行 (既存のロジック)
            checkDescriptionLength(this.value);
        });

        function checkDescriptionLength(descriptionText) {
            // CSRFトークンを取得 (LaravelのBladeディレクティブから取得)
            const token = document.querySelector('meta[name="csrf-token"]') ? 
                          document.querySelector('meta[name="csrf-token"]').content : 
                          document.querySelector('input[name="_token"]').value; 

            // Ajaxリクエスト
            fetch('{{ route("items.checkDescription") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token 
                },
                body: JSON.stringify({ description: descriptionText })
            })
            .then(response => {
                // HTTPステータスが422 (バリデーションエラー) の場合も.json()で取得
                return response.json().then(data => {
                    if (!response.ok) {
                        return Promise.reject(data);
                    }
                    return data;
                });
            })
            .then(data => {
                // 成功時 (ステータスOK)
                ajaxStatus.textContent = data.message;
                ajaxStatus.style.color = '#28a745'; // 緑色
            })
            .catch(error => {
                // エラー時 (ステータス422など)
                ajaxStatus.textContent = error.message;
                ajaxStatus.style.color = '#dc3545'; // 赤色
            });
        }
    });
</script>
@endsection