
$(document).ready(function(){
    $("#btn-change-info-or-pass").click(function() {
        var name = $("#p-inform input[name=txtName]").val();
        var pwd = $("#p-inform input[name=txtPw]").val();
        var repwd = $("#p-inform input[name=txtRpw]").val();
        var phone = $("#p-inform input[name=txtTel]").val();
        var mail = $("#p-inform input[name=txtEmail]").val();
        var pass =$("#p-inform input[name=txtPass]").val();
        $.ajax({
            url:"?m=ajax&a=change_pass",
            dataType:"json",
            type:"POST",
            data:{
                txtName:name,
                txtEmail:mail,
                txtTel:phone,
                txtPw:pwd,
                txtRpw:repwd,
                txtPass:pass
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