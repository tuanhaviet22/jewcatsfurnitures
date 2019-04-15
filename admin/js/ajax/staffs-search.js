$(document).ready(function() {
	$("input[name='txtSearch']").keyup(function() {
		var search = $("input[name='txtSearch']").val();

		$.ajax({
			url: "?m=ajax&a=staffs-search",
			type: "POST",
			dataType: "json",
			data: {search: search}
		}).done(function(data) {
			if(data != "") {
				var txt = ""; 
				for(var i in data) {
					txt += "<tr><td>" + data[i].id + "</td><td>" + data[i].stf_name + "</td>"
                    + "<td>" + data[i].stf_role + "</td><td>" + data[i].stf_phone + "</td>"
                    + "<td>" + data[i].stf_salary + "</td><td><div class='status' id='" + data[i].id + "'></div> " + data[i].stf_status + "</td>"
					+ "<td><a href='?m=staffs&a=edit&id=" + data[i].id + "'>Edit</a></td></tr>";
				}
				$("#search-records").html(txt);
			}
			else $("#search-records").text("No result");

			// display status
			$.ajax({
				url: "?m=ajax&a=staffs-status-display",
				dataType: "json",
				type: "POST",
				data: {}
			}).done(function(data) {
				if(data != "") {
					for(var i in data) {
						switch(data[i].stf_status) {
							case '0': {
								$("#" + data[i].id).css({
									"background-color": "red"
								});
								break;
							}
							case '1': {
								$("#" + data[i].id).css({
									"background-color": "#4CD864"
								});
								break;
							}
							case '2': {
								$("#" + data[i].id).css({
									"background-color": "#FFCA28"
								});
								break;
							}
						}
						
					}
				}
			});
		});
	});
});

