$(document).ready(function() {
	$("input[name='txtSearch']").keyup(function() {
		var search = $("input[name='txtSearch']").val();

		$.ajax({
			url: "?m=ajax&a=products-search",
			type: "POST",
			dataType: "json",
			data: {search: search}
		}).done(function(data) {
			if(data != "") {
				var txt = ""; 
				for(var i in data.records) {
					txt += "<tr><td>" + data.records[i].id + "</td>"
					+"<td><a href='?m=productdetails&a=list&id=" + data.records[i].id + "'>" + data.records[i].pro_name + "</a></td>"
                    +"<td>" + data.records[i].brd_name + "</td>"
                    +"<td>" + data.records[i].cat_name + "</td>"
                    +"<td>" + data.records[i].pro_price + "</td>"
                    +"<td><img src='" + data.baseUrl + "/admin/images/products/" + data.records[i].pro_img + "'></td>"
                    +"<td>" + data.records[i].pro_quantity + "</td>"
                    + "<td><div class='status-box' id='" + data.records[i].id + "'><div class='toggler'></div></div></td>"
					+ "<td><a href='?m=products&a=edit&id=" + data.records[i].id + "'>Edit</a></td></tr>";
				}
				$("#search-records").html(txt);
			}
			else $("#search-records").text("No result");

			// display status
			$.ajax({
				url: "?m=ajax&a=products-status-display",
				type: "POST",
				dataType: "json",
				data: {}
			}).done(function(data) {
				for(var i in data) {
					if(data[i]['pro_status'] == 0) {
						$("#" + data[i]['id']).css({
							'background-color':'#FE8B00',
							'border':'1px solid #FE8B00'
						});
						$("#" + data[i]['id'] + " .toggler").css({
							'left':'1px'
						});
					}
				}
			});

			// change status
			$(".status-box").click(function() {
				var idchange = $(this).attr('id');
				$.ajax({
					url: "?m=ajax&a=products-status-change",
					dataType: "json",
					type: "POST",
					data: {idchange: idchange}
				}).done(function(data) {
					if(data == 0) {
						$("#" + idchange).css({
							'background-color':'#FE8B00',
							'border':'1px solid #FE8B00'
						});
						$("#" + idchange + " .toggler").css({
							'left':'1px'
						});
					}
					if(data == 1) {
						$("#" + idchange).css({
							'background-color':'#4CD864',
							'border':'1px solid #4CD864'
						});
						$("#" + idchange + " .toggler").css({
							'left':'22px'
						});
					}
				});
			});
		});
	});
});

