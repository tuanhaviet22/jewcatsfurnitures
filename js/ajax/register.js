$(document).ready(function(){
    $("#btn-register").click(function() {
        var usn = $("input[name=txtUrs]").val();
        var pwd = $("input[name=txtPass]").val();
        var repwd = $("input[name=txtRepw]").val();
        var name = $("input[name=txtName]").val();
        var phone =$("input[name=txtTel]").val();
        var mail = $("input[name=txtEmail]").val();
        $.ajax({
            url:"?m=ajax&a=register",
            dataType:"json",
            type:"POST",
            data:{
                txtUsr:usn,
                txtPass:pwd,
                txtRepw:repwd,
                txtFullName:name,
                txtTel:phone,
                txtEmail:mail
            }
        }).done(function(data){
            if(data != '') {
                swal({
                    title : "Opps !!", 
                    text : "Your username exists or retype password is invalid" , 
                    icon : "error",
                    button: "Ok"
                });
            }
            else {
                swal({
                    title : "Thanks for register !!", 
                    text : "Please re-login" , 
                    icon : "success",
                    button: "Ok"
                }).then(function() {
                    location.reload();
                });
            }
        });
    });
        
    






});