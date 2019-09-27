<!DOCTYPE html>
<html lang="ja">
<head>
	<link rel="icon" type="image/png" href="{{ asset('img/favicon/favicon.png') }}">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css" />
	<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js" integrity="sha384-0pzryjIRos8mFBWMzSSZApWtPl/5++eIfzYmTgBBmXYdhvxPc+XcFEk+zJwDgWbP" crossorigin="anonymous"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>レポート管理システム - @yield('title')</title>
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
	<nav class="navbar navbar-expand-sm navbar-light sticky-top" style="background-color: lightblue;">
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
							<select class="form-control mr-sm-2" name="usId" required>
								<option id="" value="all" selected>全員</option>
								@foreach ($userList as $us)
									<option id="" value="{{ $us->getId() }}">{{ $us->getId() }}:{{ $us->getUsName() }}</option>
								@endforeach
							</select>
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
							<button type="submit" class="btn btn-outline-success my-2 my-sm-0">検索</button>
						</li>
					</form>
				</ul>
			</div>
			<div class="ml-auto">
				<span class="nav-item my-2 my-lg-0 mr-sm-2">ログイン中:{{ session('usName') }}様</span>
			</div>
			<a class="nav-item my-2 my-lg-0 mr-sm-2" href="/sharereports/public/reports/goAdd" role="button"><button class="btn btn-primary">レポート作成</button></a>
			<a class="nav-item my-2 my-lg-0 mr-sm-2" href="/sharereports/public/reports/searchList?usId={{ session('usId') }}&rcId=all"><button class="btn btn-info">マイページ</button></a>
			<div class="ml-auto">
				<a class="nav-item btn btn-danger mr-sm-2 my-2 my-lg-0" href="/sharereports/public/logout" role="button">ログアウト</a>
			</div>
		</div>
	</nav>
	@yield('breadcrumb')
	<div class="container">
		@yield('container')
	</div>
	<script src="{{ asset('js/app.js') }}"></script>
	@yield('script')
</body>
</html>