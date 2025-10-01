<!DOCTYPE html>
<html lang="ja">
<head>
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

    <form action="{{ route('items.store') }}" method="POST">
        @csrf <div>
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