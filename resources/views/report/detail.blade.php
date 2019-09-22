<!DOCTYPE html>
<html lang="ja">
<head>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>レポート詳細画面 / ID:{{ $report->getId() }}</title>
</head>
<body>
	<nav class="navbar navbar-light bg-light">
		<a href="../list"><h1>レポート管理システム</h1></a>
		<ul class="navbar-nav ml-auto">
			<li class="nav-item"><a class="btn btn-primary" href="/sharereports/public/reports/goAdd" role="button">新規作成</a></li>
			<li class="nav-item"><a class="btn btn-danger" href="/sharereports/public/logout" role="button">ログアウト</a></li>
		</ul>
	</nav>

	<nav aria-label="パンくずリスト">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="../list">レポートリスト</a></li>
			<li class="breadcrumb-item active" aria-current="page">レポート詳細</li>
		</ol>
	</nav>

	<div class="container">
		<h2>ID: {{ $report->getId() }}</h2>
		<dl>
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
		<a href="../prepareEdit/{{ $report->getId() }}">
			<button class="btn btn-outline-secondary" type="button">編集する</button>
		</a>
		<a href="../confirmDelete/{{ $report->getId() }}">
			<button class="btn btn-danger" type="button">削除する</button>
		</a>
	</div>

	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>