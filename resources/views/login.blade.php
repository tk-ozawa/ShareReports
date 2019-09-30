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
		<h1>ログイン</h1>

		@isset($validationMsgs)
		<section id="errorMsg">
			<p><strong>以下のメッセージをご確認ください。</strong></p>
			<ul style="list-style-type:none;">
				@foreach ($validationMsgs as $msg)
					<li>
						<div class="alert alert-danger" role="alert">{{$msg}}</div>
					</li>
				@endforeach
			</ul>
		</section>
		@endisset

		<form action="/sharereports/public/login" method="post">
			@csrf
			<div class="form-group">
				<label for="loginUsMail">ID</label>
				<input type="text" id="loginUsMail" class="form-control" name="loginUsMail" value="{{ $loginUsMail??""}}" required>
			</div>
			<div class="form-group">
				<label for="loginUsPasswd">パスワード</label>
				<input id="loginUsPasswd" class="form-control" type="password" name="loginUsPasswd" required>
			</div>
			<div class="form-group">
				<button type="submit" class="form-control btn btn-outline-info">ログイン</button>
			</div>
		</form>
		<form action="/sharereports/public/prepareRegister" method="post">
			@csrf
			<div class="form-group">
				<button type="submit" class="form-control btn btn-outline-primary">アカウント新規登録</button>
			</div>
		</form>
	</div>

	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>