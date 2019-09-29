$(function () {
	$(document).ready(function() {
		$.ajax({
			type: 'get',
			datatype: 'json',
			url: '/sharereports/public/reports/Ajax/rcListByUsId',
			data: {
				'usId': $('[id="selectUsId"]').val()
			},
			success: function (data) {
				var dataArray = data.rcList
				console.log(data.rcList)
				$("#selectRcId").empty();
				$("#selectRcId").append($("<option>").val("all").text("全作業種類"));
				$.each(dataArray, function(i) {
					$("#selectRcId").append($("<option>").val(dataArray[i].id).text(dataArray[i].id + ':' +dataArray[i].rc_name));
				})
			},
			error: function (xhr) {
				console.log("サーバー通信エラー")
				alert("通信エラー")
			},
			complete: function (xhr) {
				console.log("サーバー通信終了")
				// alert("通信終了")
			},
		})
	})

	$('[id=selectUsId]').change(function () {
		$.ajax({
			type: 'get',
			datatype: 'json',
			url: '/sharereports/public/reports/Ajax/rcListByUsId',
			data: {
				'usId': $('[id="selectUsId"]').val()
			},
			success: function (data) {
				var dataArray = data.rcList
				console.log(data.rcList)
				$("#selectRcId").empty();
				if (dataArray == null) {
					$("#selectRcId").append($("<option>").val("all").text("作業種類無し…"));
				}
				else {
					$("#selectRcId").append($("<option>").val("all").text("全作業種類"));
					$.each(dataArray, function(i) {
						$("#selectRcId").append($("<option>").val(dataArray[i].id).text(dataArray[i].id + ':' +dataArray[i].rc_name));
					})
				}
			},
			error: function (xhr) {
				console.log("サーバー通信エラー")
				alert("通信エラー")
			},
			complete: function (xhr) {
				console.log("サーバー通信終了")
			},
		})
	})
})