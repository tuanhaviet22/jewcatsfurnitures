$(document).ready(function() {
	$("input[name='txtSearch']").keyup(function() {
		var search = $("input[name='txtSearch']").val();

		$.ajax({
			url: "?m=ajax&a=brands-search",
			type: "POST",
			dataType: "json",
			data: {search: search}
		}).done(function(data) {
			if(data != "") {
				var txt = ""; 
				for(var i in data.records) {
					txt += "<tr><td>" + data.records[i].id + "</td><td>" + data.records[i].brd_name + "</td>"
					+ "<td><img src='" + data.baseUrl + "/admin/images/brands/" + data.records[i].brd_logo + "'></td>"
					+ "<td><a href='?m=brands&a=edit&id=" + data.records[i].id + "'>Edit</a></td></tr>"
				}
				$("#search-records").html(txt);
			}
			else $("#search-records").text("No result");
		});
	});
});
