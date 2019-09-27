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
				<li class="breadcrumb-item"><span>[アカウント登録]</span></li>
				<li class="breadcrumb-item"><span style="color:gray;">アカウント登録情報確認</span></li>
				<li class="breadcrumb-item"><span style="color:gray;">アカウント仮登録完了</span></li>
				<li class="breadcrumb-item"><span style="color:gray;">アカウント本登録完了</span></li>
			</ol>
		</nav>

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

		<form action="/sharereports/public/confirmRegister" method="post">
			@csrf
			<div class="form-group">
				<label for="registUsMail">メールアドレス (メールを受信できるアドレスを入力してください)</label>
				<input id="registUsMail" class="form-control" type="email"  name="registUsMail" value="{{ $user->getUsMail() }}" placeholder="xxx@xxx.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
			</div>
			<div class="form-group">
				<label for="registUsName">ユーザー名</label>
				<input id="registUsName" class="form-control" type="text" name="registUsName" value="{{ $user->getUsName() }}" placeholder="HAL太郎" required>
			</div>
			<div class="form-group">
				<label for="registUsPasswd">パスワード</label>
				<input id="registUsPasswd" class="form-control" type="password" name="registUsPasswd" value="{{ $user->getUsPassword() }}" required>
				<input type="checkbox" id="password-check">
				<label for="password-check">パスワードを表示する</label>
			</div>
			<div class="form-group">
				<button type="submit" class="form-control btn btn-outline-primary">内容を確認する</button>
			</div>
		</form>
		<form action="/sharereports/public/" method="get">
			@csrf
			<div class="form-group">
				<button class="form-control btn btn-outline-danger">ログイン画面に戻る</button>
			</div>
		</form>
	</div>
	<script src="{{ asset('js/app.js') }}"></script>
	<script>
		const pwd = document.getElementById('registUsPasswd');
		const pwdCheck = document.getElementById('password-check');
		pwdCheck.addEventListener('change', function() {
			if(pwdCheck.checked) {
				pwd.setAttribute('type', 'text');
			} else {
				pwd.setAttribute('type', 'password');
			}
		}, false);
	</script> 
</body>
</html>