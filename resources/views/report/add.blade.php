@extends('report.layouts.master')

@section('title', 'レポート登録画面')

@section('breadcrumb')
	<nav aria-label="パンくずリスト">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/sharereports/public/reports/showList">レポートリスト</a></li>
			<li class="breadcrumb-item active" aria-current="page">レポート新規登録</li>
		</ol>
	</nav>
	@isset($validationMsgs)
	<section id="errorMsg">
		<p>以下のメッセージをご確認ください。</p>
		<ul>
			@foreach ($validationMsgs as $msg)
				<li><div class="alert alert-danger" role="alert">{{$msg}}</div></li>
			@endforeach
		</ul>
	</section>
	@endisset
@endsection

@section('container')
	<form action="/sharereports/public/reports/add" method="post">
		@csrf
		<div class="form-group">
			<div class="row">
				<div class="col">
					<label for="datetimepicker1" class="pt-2 pr-2">作業日</label>
					<div class="input-group date" id="datetimepicker1" data-target-input="nearest">
						<input type="date" class="form-control datetimepicker-input" name="rpDate" data-target="#datetimepicker1" required/>
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
						<input type="time" class="form-control datetimepicker-input" name="rpTimeFrom" data-target="#datetimepicker2" required/>
						<div class="input-group-prepend" data-target="#datetimepicker2" data-toggle="datetimepicker">
							<div class="input-group-text"><i class="far fa-clock"></i></div>
						</div>
					</div>
				</div>
				<div class="col">
					<label for="datetimepicker3" class="pt-2 pr-2">作業終了時刻</label>
					<div class="input-group date" id="datetimepicker3" data-target-input="nearest">
						<input type="time" class="form-control datetimepicker-input" name="rpTimeTo" data-target="#datetimepicker3" required />
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
						@foreach ($reportCateList as $reportcate)
							<option value="{{ $reportcate->getId() }}">
								{{ $reportcate->getRcName() }}
							</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<label for="reportContent" class="pt-2 pr-2">作業内容</label>
					<textarea class="form-control" id="reportContent" name="rpContent" rows="3" required></textarea>
				</div>
			</div>
		</div>
		<div class="text-right">
			<button type="submit" class="btn btn-primary">登録する</button>
		</div>
	</form>
@endsection