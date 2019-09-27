<!DOCTYPE html>
<html lang="ja">
<head>
	<link rel="icon" type="image/png" href="{{ asset('img/favicon/favicon.png') }}">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css" />
	<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js" integrity="sha384-0pzryjIRos8mFBWMzSSZApWtPl/5++eIfzYmTgBBmXYdhvxPc+XcFEk+zJwDgWbP" crossorigin="anonymous"></script>
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>レポート管理システム</title>
</head>
<body>
	<div class="container">
		<h1>アカウント新規登録</h1>
		<nav aria-label="パンくずリスト">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><span style="color:gray;">アカウント登録</span></li>
				<li class="breadcrumb-item"><span style="color:gray;">アカウント登録情報確認</span></li>
				<li class="breadcrumb-item"><span style="color:gray;">[アカウント仮登録完了]</span></li>
				<li class="breadcrumb-item active" aria-current="page"><span style="color:black;">[アカウント本登録完了]</span></li>
			</ol>
		</nav>
		<div class="form-group">
			<div class="alert alert-success" role="alert"><strong>アカウント本登録が完了しました。</strong> ログインしてください。</div>
			<dl>
				<dt>ユーザー名:</dt>
					<dd>{{ $user->getUsName() }}</dd>
				<dt>メールアドレス:</dt>
					<dd>{{ $user->getUsMail() }}</dd>
			</dl>
		</div>
		<form action="/sharereports/public/" method="get">
			<div class="form-group">
				<button class="form-control btn btn-outline-danger">ログイン画面に戻る</button>
			</div>
		</form>
	</div>
	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>