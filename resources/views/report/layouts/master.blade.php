<!DOCTYPE html>
<html lang="ja">
<head>
	<link rel="icon" type="image/png" href="{{ asset('img/favicon/favicon.png') }}">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	@yield('head-script')
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css" />
	<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js" integrity="sha384-0pzryjIRos8mFBWMzSSZApWtPl/5++eIfzYmTgBBmXYdhvxPc+XcFEk+zJwDgWbP" crossorigin="anonymous"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>レポート管理システム - @yield('title')</title>
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<script src="{{ asset('/js/Ajax.js') }}"></script>
</head>
<body>
	<nav class="navbar navbar-expand-xl navbar-light sticky-top" style="background-color: lightblue;">
		<a class="navbar-brand" href="/sharereports/public/reports/showList">レポート管理システム</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu2a" aria-controls="navmenu2a" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navmenu2a">
			<div class="navbar-nav">
				<ul class="navbar-nav">
					<form class="form-inline my-2 my-lg-0" action="/sharereports/public/reports/searchList" method="GET">
						<input type="hidden" name="case" value="id">
						<input type="hidden" name="orderBy" value="ASC">
						<li class="nav-item">
							<select class="form-control mr-sm-2" name="usId" id="selectUsId" required>
								<option id="" value="all" selected>全員</option>
								@foreach ($userList as $us)
									<option id="" value="{{ $us->getId() }}">{{ $us->getId() }}:{{ $us->getUsName() }}</option>
								@endforeach
							</select>
						</li>
						<li class="nav-item">
							<select class="form-control mr-sm-2" name="rcId" id="selectRcId" required></select>
						</li>
						<li class="nav-item">
							<button type="submit" class="btn btn-outline-success my-2 my-sm-0">検索</button>
						</li>
					</form>
				</ul>
			</div>
			<div class="ml-auto">
				<span class="nav-item my-2 my-lg-0 mr-sm-2">ログイン中:{{ session('usName') }}様</span>
			</div>
			<a class="nav-item my-2 my-lg-0 mr-sm-2" href="/sharereports/public/reports/goAdd" role="button"><button class="btn btn-primary">レポート作成</button></a>
			<a class="nav-item my-2 my-lg-0 mr-sm-2" href="/sharereports/public/reports/searchList?case=rp_date&orderBy=ASC?usId={{ session('usId') }}&rcId=all"><button class="btn btn-info">マイページ</button></a>
			<div class="ml-auto">
				<a class="nav-item btn btn-danger mr-sm-2 my-2 my-lg-0" href="/sharereports/public/logout" role="button">ログアウト</a>
			</div>
		</div>
	</nav>
	@yield('breadcrumb')
	<div class="container">
		@yield('container')
	</div>

	<script src="{{ asset('/js/app.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/ja.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js"></script>

	<script>
		$(document).ready(function() {
			getRcList()
		})
		$('[id=selectUsId]').change(function () {
			getRcList()
		})
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
		})

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
		})

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
		})
	</script>
</body>
</html>