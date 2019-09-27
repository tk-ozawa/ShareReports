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
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	<div class="container">
		<h1>アカウント新規登録</h1>
		<nav aria-label="パンくずリスト">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="/sharereports/public/register">アカウント登録</a></li>
				<li class="breadcrumb-item active" aria-current="page"><span style="color:black;">[アカウント登録情報確認]</span></li>
				<li class="breadcrumb-item"><span style="color:gray;">アカウント仮登録完了</span></li>
				<li class="breadcrumb-item"><span style="color:gray;">アカウント本登録完了</span></li>
			</ol>
		</nav>
		<form action="/sharereports/public/completeRegister" method="post">
			@csrf
			<div class="form-group">
				<label for="registUsMail">メールアドレス</label>
				<input class="form-control" type="text" value="{{ $user->getUsMail() }}" disabled>
				<input id="registUsMail" type="hidden" name="registUsMail" value="{{ $user->getUsMail() }}">
			</div>
			<div class="form-group">
				<label for="registUsName">ユーザー名</label>
				<input class="form-control" type="text" value="{{ $user->getUsName() }}" disabled>
				<input id="registUsName" type="hidden" name="registUsName" value="{{ $user->getUsName() }}">
			</div>
				<div class="form-group">
				<label for="registUsPasswd">ユーザー名</label>
				<input class="form-control" type="password" value="{{ $user->getUsPassword() }}" disabled>
				<input id="registUsPasswd" type="hidden" name="registUsPasswd" value="{{ $user->getUsPassword() }}">
			</div>
			<div class="form-group">
				<button type="submit" class="form-control btn btn-outline-primary">この内容で登録する</button>
			</div>
		</form>
		<form action="/sharereports/public/prepareRegister" method="post">
			@csrf
			<div class="form-group">
				<input type="hidden" name="registUsMail" value="{{ $user->getUsMail() }}">
				<input type="hidden" name="registUsName" value="{{ $user->getUsName() }}">
				<input type="hidden" name="registUsPasswd" value="{{ $user->getUsPassword() }}">
				<button type="submit" class="form-control btn btn-outline-warning">入力画面に戻る</button>
			</div>
		</form>
	</div>
	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>