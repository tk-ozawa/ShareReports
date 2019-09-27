@extends('report.layouts.master')

@section('title', 'レポート削除確認画面 / ID:'.$report->getId())

@section('breadcrumb')
	<nav aria-label="パンくずリスト">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/sharereports/public/reports/showList">レポートリスト</a></li>
			<li class="breadcrumb-item"><a href="/sharereports/public/reports/detail/{{ $report->getId() }}">レポート詳細</a></li>
			<li class="breadcrumb-item active" aria-current="page">レポート削除確認</li>
		</ol>
	</nav>
@endsection

@section('container')
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
@endsection