function getRcList() {
	$(function () {
		$.ajax({
			type: 'get',
			datatype: 'json',
			url: '/sharereports/public/reports/Ajax/rcListByUsId',
			data: {
				'usId': $('[id="selectUsId"]').val()
			},
			success: function (data) {
				console.log("サーバー通信開始")
				var dataArray = data.rcList
				$("#selectRcId").empty();
				if (dataArray == null) {
					$("#selectRcId").append($("<option>").val("all").text("作業種類無し…"));
				}
				else {
					if (Object.keys(dataArray).length > 1) {
						$("#selectRcId").append($("<option>").val("all").text("全作業種類"));
						$.each(dataArray, function(i) {
							$("#selectRcId").append($("<option>").val(dataArray[i].id).text(dataArray[i].id + ':' +dataArray[i].rc_name));
						})
					}
					else {
						$("#selectRcId").append($("<option>").val(dataArray[0].id).text(dataArray[0].id + ':' +dataArray[0].rc_name));
					}
				}
			},
			error: function (xhr) {
				console.log("サーバー通信エラー")
			},
			complete: function (xhr) {
				console.log("サーバー通信終了")
			},
		})
	})
}

// $('[id=selectUsId]').change(function () {
// 	$.ajax({
// 		type: 'get',
// 		datatype: 'json',
// 		url: '/sharereports/public/reports/Ajax/rcListByUsId',
// 		data: {
// 			'usId': $('[id="selectUsId"]').val()
// 		},
// 		success: function (data) {
// 			console.log("サーバー通信開始")
// 			var dataArray = data.rcList
// 			$("#selectRcId").empty();
// 			if (dataArray == null) {
// 				$("#selectRcId").append($("<option>").val("all").text("作業種類無し…"));
// 			}
// 			else {
// 				if (Object.keys(dataArray).length > 1) {
// 					$("#selectRcId").append($("<option>").val("all").text("全作業種類"));
// 					$.each(dataArray, function(i) {
// 						$("#selectRcId").append($("<option>").val(dataArray[i].id).text(dataArray[i].id + ':' +dataArray[i].rc_name));
// 					})
// 				}
// 				else {
// 					$("#selectRcId").append($("<option>").val(dataArray[0].id).text(dataArray[0].id + ':' +dataArray[0].rc_name));
// 				}
// 			}
// 		},
// 		error: function (xhr) {
// 			console.log("サーバー通信エラー")
// 		},
// 		complete: function (xhr) {
// 			console.log("サーバー通信終了")
// 		},
// 	})
// })