$(document).ready(function() {
    $("#logout-btn").click(function() {
        $.ajax({
            url: "?m=ajax&a=logout",
            dataType: "json"
        }).done(function(data) {
            sessionStorage.removeItem('usn');
            window.location.href = data;
        });
    });
});