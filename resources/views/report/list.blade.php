<!DOCTYPE html>
<html lang="ja">
<head>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>レポートリスト画面</title>
</head>
<body>
	<nav class="navbar navbar-light bg-light">
		<a href="./showList"><h1>レポート管理システム</h1></a>
		<ul class="navbar-nav ml-auto">
			<li class="nav-item"><a class="btn btn-primary" href="./goAdd" role="button">新規作成</a></li>
			<li class="nav-item"><a class="btn btn-danger" href="/sharereports/public/logout" role="button">ログアウト</a></li>
		</ul>
	</nav>

	@if (session("flashMsg"))
	<section id="flashMsg">
		<p>{{ session("flashMsg") }}</p>
	</section>
	@endif

	<?php $cnt = 0; ?>
	@foreach ($reportList as $report)
		@if ($cnt > 2)
			<?php $cnt = 0; ?>
		@endif
		@if ($cnt === 0)
		<div class="card-deck">
		@endif
			<div class="card">
				<h2 class="card-header">
					<span>ID:{{ $report->getId() }}</span>
				</h2>
				<div class="card-body">
					<h2 class="card-title">報告者ID:{{ $report->getUserId() }}</h2>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item">作業日:{{ $report->getRpDate() }}</li>
					<li class="list-group-item">
						作業種類:
						<img src="../img/reportcate/1.jpg">
						{{-- <img src="{{ asset('/img/reportcate/.jpg') }}" alt="Card image cap" class="float-right"> --}}
					</li>
				</ul>
				<div class="card-body">
					<a href="#" class="btn btn-primary">詳細</a>
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


	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>