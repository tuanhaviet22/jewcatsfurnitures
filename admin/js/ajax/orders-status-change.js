$(document).ready(function() {
    $("select[name='selectorStatus']").change(function() {
        var stt = this.value;
        var id = getId($(this).attr('id'));

        $.ajax({
            url: "?m=ajax&a=orders-status-change",
            dataType: "json",
            type: "POST",
            data: {"id": id, "stt": stt}
        }).done(function() {
            // display changed status
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
        
    });



});

function getId(str) {
    var rs = "";
    for(var i = str.length - 1; i >= 0; i--) {
        if(str[i] != '-') rs = str[i] + rs;
        else break;
    }

    return rs;
}