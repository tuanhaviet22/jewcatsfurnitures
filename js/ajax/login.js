$(document).ready(function(){
    $("#btn-login").click(function() {
        var usn = $("input[name=txtUsn]").val();
        var pwd = $("input[name=txtPw]").val();

        $.ajax({
            url:"?m=ajax&a=login",
            dataType:"json",
            type:"POST",
            data:{
                txtUsn:usn,
                txtPw:pwd
            }
        }).done(function(data){
            if(data.errors != '') {
                swal({
                    title : "Opps !", 
                    text : "Your username or password is incorrect", 
                    icon : "error",
                    button: "Ok"
                });
            }
            else {
                sessionStorage.setItem("usn", data.cus_usn);
                
                swal({
                    title : "Welcome " + data.cus_name + " !", 
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