$(document).ready(function() {
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

});