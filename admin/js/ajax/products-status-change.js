$(document).ready(function() {
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