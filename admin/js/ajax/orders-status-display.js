$(document).ready(function() {
    $.ajax({
        url: "?m=ajax&a=orders-status-display",
        dataType: "json",
        type: "POST",
        data: {}
    }).done(function(data) {
        for(var i in data) {
            switch(data[i].ord_status) {
                case '-1': {
                    $("#select-" + data[i].id + " option[value=-1]").attr('selected', 'selected');
                    $("#" + data[i].id).css({
                        "background-color": "red"
                    });
                    break;
                }
                case '0': {
                    $("#select-" + data[i].id + " option[value=0]").attr('selected', 'selected');
                    $("#" + data[i].id).css({
                        "background-color": "#FFCA28"
                    });
                    break;
                }
                case '1': {
                    $("#select-" + data[i].id + " option[value=1]").attr('selected', 'selected');
                    $("#" + data[i].id).css({
                        "background-color": "#4CD864"
                    });
                    break;
                }
            }
                
        }
    });



});