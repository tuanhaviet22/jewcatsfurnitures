$(document).ready(function(){
    $("#btn-change-adr").click(function() {
        
        var adr = $("#pa-inform input[name=txtAddress]").val();
        
        $.ajax({
            url:"?m=ajax&a=change_adr",
            dataType:"json",
            type:"POST",
            data:{
                txtadr:adr
            }
        }).done(function(data){
            if(data != '') {
                swal({
                    title : "Opps !", 
                    text : "Your username exists or retype password is invalid" , 
                    icon : "error",
                    button: "Ok"
                });
            }
            else {
                swal({
                    title : "hiluu",
                    text : "Join with us and choose the best choices for your house" , 
                    icon : "success",
                    button: "Ok"
                }).then(function() {
                    location.reload();
                });
            }
        });
    });
        
    






});