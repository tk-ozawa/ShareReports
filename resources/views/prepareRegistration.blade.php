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
	<title>レポート管理システム</title>
</head>
	<div class="container">
		<h1>アカウント新規登録</h1>

		<form action="/sharereports/public/confirmRegister" method="post">
			@csrf
			<div class="form-group">
				<label for="registUsMail">メールアドレス (メールを受信できるアドレスを入力してください)</label>
				<input id="registUsMail" class="form-control" type="email"  name="registUsMail" value="test_{{ uniqid() }}@gmail.com" placeholder="xxx@xxx.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
			</div>
			<div class="form-group">
				<label for="registUsName">ユーザー名</label>
				<input id="registUsName" class="form-control" type="text" name="registUsName" value="テストユーザー{{ uniqid() }}" placeholder="HAL太郎" required>
			</div>
			<div class="form-group">
				<label for="registUsPasswd">パスワード</label>
				<input id="registUsPasswd" class="form-control" type="password" name="registUsPasswd" value="hogehoge" required>
			</div>
			<button type="submit" class="form-control">この内容で登録する</button>
		</form>
	</div>
	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>