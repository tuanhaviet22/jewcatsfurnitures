$(document).ready(function() {
	$("input[name='txtSearch']").keyup(function() {
		var search = $("input[name='txtSearch']").val();

		$.ajax({
			url: "?m=ajax&a=customers-search",
			type: "POST",
			dataType: "json",
			data: {search: search}
		}).done(function(data) {
			if(data != "") {
				var txt = ""; 
				for(var i in data) {
					txt += "<tr><td>" + data[i].id + "</td><td>" + data[i].cus_name + "</td>"
                    + "<td>" + data[i].cus_usn + "</td><td>" + data[i].cus_phone + "</td>"
                    + "<td>" + data[i].cus_mail + "</td></tr>";
				}
				$("#search-records").html(txt);
			}
			else $("#search-records").text("No result");
		});
	});
});

