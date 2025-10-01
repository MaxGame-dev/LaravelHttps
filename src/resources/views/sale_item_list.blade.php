<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>出品情報</title>
</head>
<body>
  <h1>出品情報</h1>
<p>
	商品タイトル：{{$item_title}}<br>
	商品説明：{{$item_description}}<br>
	開始価格：{{$item_start_price}}<br>
	販売期限：{{$item_expired_date}}<br>
	@if ($item_image)
    	商品画像：<br>
		<img src="{{ asset('storage/' . $item_image) }}" alt="{{ $item_title }}" style="max-width: 300px;">
	@else
    	商品画像：画像はありません。
	@endif
</p>
</body>
</html>