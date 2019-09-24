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
	<title>レポートリスト画面</title>
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
					<select class="form-control mr-sm-2" id="usId" name="usId" required>
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
			<li class="breadcrumb-item active" aria-current="page">レポート検索結果</li>
		</ol>
	</nav>

	<div class="container">
		@empty($reportList)
		<h2>レポートがありません。</h2>
		@else
			<h2>"ユーザー名: {{ $user->getUsName() }}"さんの投稿レポート検索結果</h2>
			<?php $cnt = 0; ?>
			@foreach ($reportList as $report)
				@if ($cnt > 2)
					<?php $cnt = 0; ?>
				@endif
				@if ($cnt === 0)
				<div class="card-deck">
				@endif
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">ID:{{ $report->getId() }}</h3>
						</div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item">報告者ID:{{ $report->getUserId() }}</li>
							<li class="list-group-item">作業日:{{ $report->getRpDate() }}</li>
							<li class="list-group-item">
								作業種類:
								<img src="../img/reportcate/{{ $report->getReportCateId() }}.jpg">
							</li>
						</ul>
						<div class="card-body">
							<a href="./detail/{{ $report->getId() }}" class="btn btn-primary">詳細</a>
						</div>
					</div>
					<?php $cnt++; ?>
					@if ($cnt % 3 === 0)
					</div>
					@endif
				@endforeach
			@if ($cnt < 2)
				<div class="card"></div>
			@endif
			@if ($cnt < 3)
				<div class="card"></div>
				</div>
			@endif
		@endif


	</div>

	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>