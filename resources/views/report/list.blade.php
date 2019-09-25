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
			<form class="form-inline my-2 my-lg-0" action="/sharereports/public/reports/searchList" method="GET">
				<li class="nav-item">
					絞り込み:
				</li>
				<li class="nav-item">
					<select class="form-control mr-sm-2" name="usId" required>
						<option id="" value="all" selected>全員</option>
						@foreach ($userList as $us)
							<option id="" value="{{ $us->getId() }}">{{ $us->getId() }}:{{ $us->getUsName() }}</option>
						@endforeach
					</select>
				</li>
				<li class="nav-item">
					の
				</li>
				<li class="nav-item">
					<select class="form-control mr-sm-2" name="rcId" required>
						<option id="" value="all" selected>全作業種類</option>
						@foreach ($reportCateList as $rpCate)
							<option id="" value="{{ $rpCate->getId() }}">{{ $rpCate->getId() }}:{{ $rpCate->getRcName() }}</option>
						@endforeach
					</select>
				</li>
				<li class="nav-item">
					を対象で
				</li>
				<li class="nav-item">
					<button type="submit" class="btn btn-outline-success my-2 my-sm-0">検索</button>
				</li>
			</form>
		</ul>
		<div class="ml-auto">
			<a class="btn btn-primary" href="/sharereports/public/reports/goAdd" role="button">レポート作成</a>
			<a href="/sharereports/public/reports/searchList?usId={{ session('usId') }}&rcId=all"><button class="btn btn-info">マイページ</button></a>
			<span>ログイン中:{{ session('usName') }}様</span>
			<a class="btn btn-danger" href="/sharereports/public/logout" role="button">ログアウト</a>
		</div>
	</nav>

	<div class="container">
		@if (session("flashMsg"))
		<section id="flashMsg">
			<p>{{ session("flashMsg") }}</p>
		</section>
		@endif

		@empty($reportList)
		<h2>レポートがありません。</h2>
		@else
			<form action="/sharereports/public/reports/showList" method="get">
				<select name="case" id="" required>
					<option value="id" selected>レポートID</option>
					<option value="rp_date" @if($case === "rp_date") selected @endif>作業日</option>
					<option value="rp_created_at" @if($case === "rp_created_at") selected @endif>レポート登録日時</option>
				</select>
				<span>の</span>
				<select name="orderBy" id="" required>
					<option value="ASC" @if($orderBy === 'ASC') selected @endif>昇順</option>
					<option value="DESC" @if($orderBy === 'DESC') selected @endif>降順</option>
				</select>
				<span>で</span>
				<button type="submit" class="btn btn-outline-success">並び替え</button>
			</form>
			<h2>レポート一覧(TOP)</h2>
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