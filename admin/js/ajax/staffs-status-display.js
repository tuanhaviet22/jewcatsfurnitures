$(document).ready(function() {
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