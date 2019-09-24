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
	<title>レポート編集画面 / ID:{{ $report->getId() }}</title>
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
			<li class="breadcrumb-item active" aria-current="page">レポート編集</li>
		</ol>
	</nav>

	@isset($validationMsgs)
	<section id="errorMsg">
		<p>以下のメッセージをご確認ください。</p>
		<ul>
			@foreach ($validationMsgs as $msg)
				<li>{{$msg}}</li>
			@endforeach
		</ul>
	</section>
	@endisset

	<div class="container">
		<h2>レポートID: {{ $report->getId() }}</h2>
		<form action="/sharereports/public/reports/edit" method="post">
			@csrf
			<input type="hidden" name="rpId" value="{{ $report->getId() }}">
			<div class="form-group">
				<div class="row">
					<div class="col">
						<label for="datetimepicker1" class="pt-2 pr-2">作業日</label>
						<div class="input-group date" id="datetimepicker1" data-target-input="nearest">
							<input type="text" class="form-control datetimepicker-input" name="rpDate" data-target="#datetimepicker1" value="{{ $report->getRpDate() }}" required />
							<div class="input-group-prepend" data-target="#datetimepicker1" data-toggle="datetimepicker">
								<div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label for="datetimepicker2" class="pt-2 pr-2">作業開始時刻</label>
						<div class="input-group date" id="datetimepicker2" data-target-input="nearest">
							<input type="text" class="form-control datetimepicker-input" name="rpTimeFrom" data-target="#datetimepicker2" value="{{ $report->getRpTimeFrom() }}" required />
							<div class="input-group-prepend" data-target="#datetimepicker2" data-toggle="datetimepicker">
								<div class="input-group-text"><i class="far fa-clock"></i></div>
							</div>
						</div>
					</div>
					<div class="col">
						<label for="datetimepicker3" class="pt-2 pr-2">作業終了時刻</label>
						<div class="input-group date" id="datetimepicker3" data-target-input="nearest">
							<input type="text" class="form-control datetimepicker-input" name="rpTimeTo" data-target="#datetimepicker3" value="{{ $report->getRpTimeTo() }}" required />
							<div class="input-group-prepend" data-target="#datetimepicker3" data-toggle="datetimepicker">
								<div class="input-group-text"><i class="far fa-clock"></i></div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label for="reportcates" class="pt-2 pr-2">作業種類</label>
						<select class="custom-select" id="reportcates" name="reportCateId" required>
							<option selected disabled value="">選択...</option>
							@foreach ($reportcateList as $reportcate)
								<option value="{{ $reportcate->getId() }}" @if( $reportcate->getId()  == $report->getReportCateId()) selected @endif>
									{{ $reportcate->getRcName() }}
								</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label for="reportContent" class="pt-2 pr-2">作業内容</label>
						<textarea class="form-control" id="reportContent" name="rpContent" rows="3" required>{{ $report->getRpContent() }}</textarea>
					</div>
				</div>
			</div>
			<div class="float-left">
					<a href="../detail/{{ $report->getId() }}">
						<button class="btn btn-outline-secondary" type="button">戻る</button>
					</a>
				<button type="submit" class="btn btn-primary">この内容に変更する</button>
			</div>
		</form>
	</div>

	<script src="{{ asset('js/app.js') }}"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/ja.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js"></script>
	<script type="text/javascript">
		$(function () {
			$('#datetimepicker1').datetimepicker({
				dayViewHeaderFormat: 'YYYY年 M月',
				tooltips: {
					close: '閉じる',
					selectMonth: '月を選択',
					prevMonth: '前月',
					nextMonth: '次月',
					selectYear: '年を選択',
					prevYear: '前年',
					nextYear: '次年',
					selectTime: '時間を選択',
					selectDate: '日付を選択',
					prevDecade: '前期間',
					nextDecade: '次期間',
					selectDecade: '期間を選択',
					prevCentury: '前世紀',
					nextCentury: '次世紀'
				},
				format: 'YYYY-MM-DD',
				locale: moment.locale('ja', {
					week: { dow: 0 }
				}),
				viewMode: 'days',
				buttons: {
					showClose: true
				},
				maxDate: moment().add(30, 'days').calendar()
			});

			$('#datetimepicker2').datetimepicker({
				tooltips: {
					close: '閉じる',
					pickHour: '時間を取得',
					incrementHour: '時間を増加',
					decrementHour: '時間を減少',
					pickMinute: '分を取得',
					incrementMinute: '分を増加',
					decrementMinute: '分を減少',
					pickSecond: '秒を取得',
					incrementSecond: '秒を増加',
					decrementSecond: '秒を減少',
					togglePeriod: '午前/午後切替',
					selectTime: '時間を選択'
				},
				format: 'HH:mm',
				locale: 'ja',
				buttons: {
					showClose: true
				},
			});

			$('#datetimepicker3').datetimepicker({
				tooltips: {
					close: '閉じる',
					pickHour: '時間を取得',
					incrementHour: '時間を増加',
					decrementHour: '時間を減少',
					pickMinute: '分を取得',
					incrementMinute: '分を増加',
					decrementMinute: '分を減少',
					pickSecond: '秒を取得',
					incrementSecond: '秒を増加',
					decrementSecond: '秒を減少',
					togglePeriod: '午前/午後切替',
					selectTime: '時間を選択'
				},
				format: 'HH:mm',
				locale: 'ja',
				buttons: {
					showClose: true
				},
			});
		});
	</script>
</body>
</html>