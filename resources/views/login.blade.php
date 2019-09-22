<!DOCTYPE html>
<html lang="ja">
<head>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css" />
	<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js" integrity="sha384-0pzryjIRos8mFBWMzSSZApWtPl/5++eIfzYmTgBBmXYdhvxPc+XcFEk+zJwDgWbP" crossorigin="anonymous"></script>
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ログイン</title>
</head>
<body>
	<h1>ログイン</h1>

	@isset($validationMsgs)
	<section id="errorMsg">
		<p>以下のメッセージをご確認ください。</p>
		<ul>
			@foreach ($validationMsgs as $msg)
			<li>{{$msg}}</li>
			@endforeach
		</ul>
	</section>
	@endisset

	<form action="/sharereports/public/login" method="post">
		@csrf
		<div class="form-group">
			<label for="loginUsMail">ID</label>
			<input type="text" id="loginUsMail" class="form-control" name="loginUsMail" value="architshin@websarva.com" required>
		</div>
		<div class="form-group">
			<label for="loginUsPasswd">パスワード</label>
			<input id="loginUsPasswd" class="form-control" type="password" name="loginUsPasswd" value="hogehoge" required>
		</div>
		<button type="submit" class="form-control">ログイン</button>
	</form>

	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>