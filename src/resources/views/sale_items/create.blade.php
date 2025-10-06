<!DOCTYPE html>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const textarea = document.getElementById('item_description');
    const charCount = document.getElementById('char-count');
    const ajaxStatus = document.getElementById('ajax-validation-status'); // 新しい要素
    const maxLength = 30;

    textarea.addEventListener('input', function() {
        const currentLength = this.value.length;
        
        // 1. リアルタイム文字数表示
        charCount.textContent = `現在 ${currentLength} / ${maxLength} 文字`;

        // 2. 超過チェックと表示色変更
        if (currentLength > maxLength) {
            const overCount = currentLength - maxLength;
            charCount.textContent = `超過: ${overCount} 文字 (${currentLength} / ${maxLength})`;
            charCount.style.color = 'red';
            
            // 3. (オプション) 30文字を超えた分を切り捨てる
            // this.value = this.value.substring(0, maxLength); 
            
        } else {
            charCount.style.color = 'initial'; // 通常の色に戻す
        }
        
        // 4. 文字数が変わるたびにAjaxチェックを実行
        checkDescriptionLength(this.value); 
    });

    /**
     * Ajaxを使用してサーバー側で商品説明の文字数をチェックする関数
     */
    function checkDescriptionLength(descriptionText) {
        // CSRFトークンを取得
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // フォームデータを作成
        const formData = new FormData();
        formData.append('description', descriptionText);

        fetch("{{ route('items.checkDescription') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token, // CSRFトークンをヘッダーに含める
                'Accept': 'application/json' // JSONレスポンスを期待
            },
            body: formData
        })
        .then(response => {
            // ステータスコードが422 (エラー) の場合はJSONとして処理
            if (response.status === 422) {
                return response.json().then(data => {
                    ajaxStatus.textContent = data.message;
                    ajaxStatus.style.color = 'red';
                });
            } 
            // 200 OK の場合は成功メッセージをクリア
            if (response.ok) {
                ajaxStatus.textContent = ''; // 成功時はメッセージをクリア
                return;
            }
            throw new Error('ネットワークエラーまたはその他の問題が発生しました。');
        })
        .catch(error => {
            console.error('Ajaxエラー:', error);
            // ajaxStatus.textContent = 'サーバーとの通信中にエラーが発生しました。';
        });
    }
});
</script>
<html lang="ja">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <title>出品登録</title>
</head>
<body>
    <h1>出品登録</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="item_title">商品タイトル:</label>
            <input type="text" id="item_title" name="item_title" value="{{ old('item_title') }}" required>
            @error('item_title')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <br>

        <div>
            <label for="item_description">商品説明:</label>
            <textarea id="item_description" name="item_description" required>{{ old('item_description') }}</textarea>
            <p id="char-count">現在 0 / 30 文字</p>
            <p id="ajax-validation-status" style="color: red;"></p> 
        </div>
        <br>

        <div>
            <label for="item_image">商品画像:</label>
            <input type="file" id="item_image" name="item_image" accept="image/*">
            @error('item_image')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <br>

        <div>
            <label for="start_price">開始価格 (円):</label>
            <input type="number" id="start_price" name="start_price" value="{{ old('start_price') }}" required min="1">
        </div>
        <br>

        <div>
            <label for="expired_date">終了日時:</label>
            <input type="datetime-local" id="expired_date" name="expired_date" value="{{ old('expired_date') }}" required>
        </div>
        <br>

        <button type="submit">出品する</button>
    </form>
</body>
</html>