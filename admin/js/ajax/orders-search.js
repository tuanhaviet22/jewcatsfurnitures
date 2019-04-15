$(document).ready(function() {
	$("input[name='txtSearch']").keyup(function() {
		var search = $("input[name='txtSearch']").val();

		$.ajax({
			url: "?m=ajax&a=orders-search",
			type: "POST",
			dataType: "json",
			data: {search: search}
		}).done(function(data) {
			if(data != "") {
				var txt = ""; 
				for(var i in data) {
					txt += "<tr><td>" + data[i].id + "</td><td>" + data[i].ord_datetime + "</td>"
                    + "<td>" + data[i].cus_name + "</td><td>" + data[i].stf_name + "</td>"
                    + "<td>" + data[i].ord_price + "</td>"
                    + "<td><a href='?m=orderdetails&a=list&id=" + data[i].id + "'>Details</td></tr>";
				}
				$("#search-records").html(txt);
			}
			else $("#search-records").text("No result");
		});
	});
});

