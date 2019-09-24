<!DOCTYPE html>
<html lang="ja">
<head>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css" />
	<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js" integrity="sha384-0pzryjIRos8mFBWMzSSZApWtPl/5++eIfzYmTgBBmXYdhvxPc+XcFEk+zJwDgWbP" crossorigin="anonymous"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>レポート削除確認画面 / ID:{{ $report->getId() }}</title>
</head>
<body>
	<nav class="navbar navbar-light bg-light">
		<a href="/sharereports/public/reports/showList"><h1>レポート管理システム</h1></a>
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="btn btn-primary" href="/sharereports/public/reports/goAdd" role="button">新規作成</a>
			</li>
		</ul>
		<ul class="navbar-nav mr-auto">
			<form class="form-inline my-2 my-lg-0" action="/sharereports/public/reports/searchList" method="GET">
				<li class="nav-item">
					レポート絞り込み:
					<select class="form-control mr-sm-2" name="usId" required>
						<option id="" value="" disabled selected>選択…</option>
						@foreach ($userList as $us)
							<option id="" value="{{ $us->getId() }}">{{ $us->getId() }}:{{ $us->getUsName() }}</option>
						@endforeach
					</select>
				</li>
				<li class="nav-item">
					<button type="submit" class="btn btn-outline-success my-2 my-sm-0">検索</button>
				</li>
			</form>
		</ul>
		<div class="ml-auto">
			<span>ログイン中:{{ session('usName') }}様</span>
			<a class="btn btn-danger" href="/sharereports/public/logout" role="button">ログアウト</a>
		</div>
	</nav>

	<nav aria-label="パンくずリスト">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/sharereports/public/reports/showList">レポートリスト</a></li>
			<li class="breadcrumb-item"><a href="/sharereports/public/reports/detail/{{ $report->getId() }}">レポート詳細</a></li>
			<li class="breadcrumb-item active" aria-current="page">レポート削除確認</li>
		</ol>
	</nav>

	<div class="container">
		<h2>以下の内容を削除しますか？</h2>
		<dl>
			<dt>レポートID:</dt>
				<dd>{{ $report->getId() }}</dd>
			<dt>報告者名:</dt>
				<dd>{{ $user->getUsName() }} (<a href="mailto:{{ $user->getUsMail() }}" target="_blank">{{ $user->getUsMail() }}</a>)</dd>
			<dt>作業日時:</dt>
				<dd>{{ $report->getRpDate() }} {{ $report->getRpTimeFrom() }} ~ {{ $report->getRpTimeTo() }}</dd>
			<dt>作業種類名:</dt>
				<dd>{{ $reportcate->getRcName() }}</dd>
			<dt>作業内容:</dt>
				<dd>{!! nl2br($report->getRpContent()) !!}</dd>
			<dt>レポート登録日時</dt>
				<dd>{{ $report->getRpCreatedAt() }}</dd>
		</dl>
		<a href="../detail/{{ $report->getId() }}">
			<button class="btn btn-outline-secondary" type="button">戻る</button>
		</a>
		<form action="../delete" method="post">
			@csrf
			<input type="hidden" name="deleteRpId" name="deleteRpId" value="{{ $report->getId() }}">
			<button class="btn btn-danger" type="submit">削除する</button>
		</form>
	</div>

	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>