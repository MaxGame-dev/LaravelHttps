<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '管理画面')</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans JP', sans-serif;
            margin: 0;
            background-color: #f4f7f6; /* 淡い背景色 */
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 960px;
            margin: 40px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1); /* 柔らかい影 */
        }
        header {
            background-color: #5a80a2; /* 落ち着いた青 */
            color: white;
            padding: 20px 0;
            text-align: center;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            margin: -30px -30px 30px -30px; /* containerのパディングを相殺 */
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        h1, h2, h3 {
            color: #3f5f7f; /* ヘッダーと合わせる濃い青 */
            margin-bottom: 20px;
        }
        hr {
            border: none;
            border-top: 1px solid #eee;
            margin: 30px 0;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            color: #555;
        }
        input[type="text"],
        input[type="number"],
        textarea {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.06);
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus {
            border-color: #8bbde9; /* フォーカス時の色 */
            outline: none;
        }
        .button-primary {
            display: inline-block;
            background-color: #5a80a2;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 17px;
            font-weight: 700;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .button-primary:hover {
            background-color: #4a6c8b;
            transform: translateY(-2px);
        }
        .button-back {
            display: inline-block;
            background-color: #f0f2f5; /* 淡いグレー */
            color: #555;
            padding: 10px 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            text-decoration: none;
            margin-top: 30px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .button-back:hover {
            background-color: #e2e4e7;
            border-color: #ccc;
        }
        .alert {
            background-color: #e9f7ef;
            color: #28a745;
            border: 1px solid #c3e6cb;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .error-message {
            color: #dc3545;
            font-size: 0.9em;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>@yield('header_title', '管理画面')</h1>
        </header>

        <main>
            @yield('content')
        </main>

        <div style="text-align: center; margin-top: 40px;">
            <a href="{{ route('dashboard') }}" class="button-back">
                ← 管理画面ダッシュボードに戻る
            </a>
        </div>
    </div>
    {{-- ここに各ページ固有のJavaScriptを挿入するためのセクションを追加 --}}
    @yield('scripts')
</body>
</html>