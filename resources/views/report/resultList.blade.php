@extends('report.layouts.master')

@section('title', 'レポート検索結果')

@section('head-script')
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
@endsection

@section('breadcrumb')
	<nav aria-label="パンくずリスト">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/sharereports/public/reports/showList">レポートリスト</a></li>
			<li class="breadcrumb-item active" aria-current="page">レポート検索結果</li>
		</ol>
	</nav>
@endsection

@section('container')
	@empty($reportList)
	<h2>レポートがありません。</h2>
	@else
		<ul class="navbar-nav">
			<form class="form-inline my-2 my-lg-0" action="/sharereports/public/reports/searchList" method="get">
				<input type="hidden" name="usId" value="{{ $user->getId() }}">
				<input type="hidden" name="rcId" value="{{ $rcId }}">
				<li class="nav-item">
					<select class="form-control mr-sm-2" name="case" id="" required>
						<option value="id" @if($case === "id") selected @endif>レポートID</option>
						<option value="rp_date" @if($case === "rp_date") selected @endif>作業日</option>
						<option value="rp_created_at" @if($case === "rp_created_at") selected @endif>レポート登録日時</option>
					</select>
				</li>
				<li class="nav-item">
					<select class="form-control mr-sm-2" name="orderBy" id="" required>
						<option value="ASC" @if($orderBy === 'ASC') selected @endif>昇順</option>
						<option value="DESC" @if($orderBy === 'DESC') selected @endif>降順</option>
					</select>
				</li>
				<li class="nav-item">
					<button type="submit" class="btn btn-outline-success">並び替え</button>
				</li>
			</form>
		</ul>
		@if(!empty($user))
		<h2>"ユーザー名: {{ $user->getUsName() }}"さんの投稿レポート検索結果</h2>
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
					<div class="card-header">
						<h3 class="card-title">ID:{{ $report->getId() }}</h3>
					</div>
					<ul class="list-group list-group-flush">
						<li class="list-group-item"><a href="/sharereports/public/reports/searchList?case=id&orderBy=ASC&usId={{ $report->getUserId() }}&rcId=all">報告者ID:{{ $report->getUserId() }}</a></li>
						<li class="list-group-item">
							<span>本文:</span>
							<p>{!! mb_substr($report->getRpContent(), 0, 10) !!}@if(mb_strlen($report->getRpContent()) > 10) ... @endif</p>
						</li>
						<li class="list-group-item">作業日:{{ $report->getRpDate() }}</li>
						<li class="list-group-item">
							作業種類:
							<a href="/sharereports/public/reports/searchList?case=id&orderBy=ASC&usId=all&rcId={{ $report->getReportCateId() }}"><img src="../img/reportcate/{{ $report->getReportCateId() }}.jpg"></a>
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
			<div class="card none"></div>
		@endif
		@if ($cnt < 3)
			<div class="card none"></div>
			</div>
		@endif
	@endif
@endsection