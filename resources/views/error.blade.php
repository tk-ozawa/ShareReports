<!DOCTYPE html>
<html lang="ja">
<head>
	<link rel="icon" type="image/png" href="{{ asset('img/favicon/favicon.png') }}">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Error | レポート管理システム</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	<h1>Error</h1>
	<section>
		<h2>申し訳ございません。障害が発生しました。</h2>
		<p>
			以下のメッセージご確認ください。<br>
			{{ $errorMsg }}
		</p>
	</section>
	<p><a href="/sharereports/public/">ログインへ戻る</a></p>
</body>
</html>