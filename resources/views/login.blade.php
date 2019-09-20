<!DOCTYPE html>
<html lang="ja">
<head>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ログイン</title>
</head>
<body>
	<h1>ログイン</h1>

	<form action="/sharereports/public/login" method="post">
		@csrf
		<div class="form-group">
			<label for="loginEmail">ID</label>
			<input type="text" id="loginEmail" class="form-control" name="loginEmail" value="" required>
		</div>
		<div class="form-group">
			<label for="loginPassword">パスワード</label>
			<input id="loginPassword" class="form-control" type="password" name="loginPassword">
		</div>
		<button type="submit" class="form-control">ログイン</button>
	</form>

	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>