@extends('report.layouts.master')

@section('title', 'レポート詳細画面 / ID:'.$report->getId())

@section('breadcrumb')
	<nav aria-label="パンくずリスト">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/sharereports/public/reports/showList">レポートリスト</a></li>
			<li class="breadcrumb-item active" aria-current="page">レポート詳細</li>
		</ol>
	</nav>
@endsection

@section('container')
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
	@if (session('auth') == 1)
	<a href="../prepareEdit/{{ $report->getId() }}">
		<button class="btn btn-outline-secondary" type="button">編集する</button>
	</a>
	<a href="../confirmDelete/{{ $report->getId() }}">
		<button class="btn btn-danger" type="button">削除する</button>
	</a>
	@else
	<span style="color:gray;">[ご利用中のアカウントでは編集権限がありません。]</span>
	@endif
@endsection