<!DOCTYPE html>
<html lang="ja">
<head>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	<nav class="navbar navbar-light bg-light">
		<h1>レポート情報リスト</h1>
		<a class="btn btn-primary" href="/sharereports/public/logout" role="button">ログアウト</a>
	</nav>
	<div class="card-deck">
		<div class="card">
			<h2 class="card-header">
				<span>レポートID</span>
			</h2>
			<div class="card-body">
				<h2 class="card-title">報告者01</h2>
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item">作業日</li>
				<li class="list-group-item">
					作業種類:
					<img src="{{ asset('/img/reportcate/1.jpg') }}" alt="Card image cap" class="float-right">
				</li>
			</ul>
			<div class="card-body">
				<a href="#" class="btn btn-primary">詳細</a>
			</div>
		</div>

		<div class="card">
			<h2 class="card-header">
				<span>レポートID</span>
			</h2>
			<div class="card-body">
				<h2 class="card-title">報告者01</h2>
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item">作業日</li>
				<li class="list-group-item">
					作業種類:
					<img src="{{ asset('/img/reportcate/1.jpg') }}" alt="Card image cap" class="float-right">
				</li>
			</ul>
			<div class="card-body">
				<a href="#" class="btn btn-primary">詳細</a>
			</div>
		</div>

		<div class="card">
			<h2 class="card-header">
				<span>レポートID</span>
			</h2>
			<div class="card-body">
				<h2 class="card-title">報告者01</h2>
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item">作業日</li>
				<li class="list-group-item">
					作業種類:
					<img src="{{ asset('/img/reportcate/1.jpg') }}" alt="Card image cap" class="float-right">
				</li>
			</ul>
			<div class="card-body">
				<a href="#" class="btn btn-primary">詳細</a>
			</div>
		</div>
	</div>
	<div class="card-deck">
		<div class="card">
			<h2 class="card-header">
				<span>レポートID</span>
			</h2>
			<div class="card-body">
				<h2 class="card-title">報告者01</h2>
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item">作業日</li>
				<li class="list-group-item">
					作業種類:
					<img src="{{ asset('/img/reportcate/1.jpg') }}" alt="Card image cap" class="float-right">
				</li>
			</ul>
			<div class="card-body">
				<a href="#" class="btn btn-primary">詳細</a>
			</div>
		</div>
		<div class="card"></div>
		<div class="card"></div>
	</div>

	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>