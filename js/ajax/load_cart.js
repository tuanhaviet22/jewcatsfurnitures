$(document).ready(function() {
    
    if(sessionStorage.cart && JSON.parse(sessionStorage.getItem('cart')).length > 0) {
        cart_list = JSON.parse(sessionStorage.getItem('cart'));

        // GET PRO ID ARRAY IN CART
        var arrid = [];
        for(var i in cart_list) {
            arrid.push(cart_list[i].id);
        }

        // GET PRO DETAILS
        $.ajax({
            url: "?m=ajax&a=load_cart",
            type: "POST",
            dataType: "json",
            data: {
                arrid: arrid
            }
        }).done(function(data) {
            var html = '';
            var total_price = 0;
            var total_quantity = 0;

            // LOAD CART LIST & TOTAL PRICE
            for(var i in data) {
                html += "<div class='row'><div class='col-3'>"
                    + "<img src='" + data[i].baseUrl + "/admin/images/products/" + data[i].pro_img + "'></div>"
                    + "<div class='col-3'><p style='font-size: 20px;'>" + data[i].pro_name + "</p></div>"
                    + "<div class='col-3'><p class='cl' style='font-size: 20px;'>" + data[i].pro_price + "$</p></div>"
                    + "<div class='col-3'><p>"
                    + "<button type='button' class='fixline btn btn-danger decrease-btn'>-</button>"
                    + "<input style='background:white' disabled name='quant' class='fixline1 form-control input-number' value='" + cart_list[i].quantity + "' type='text'>" 
                    + "<button type='button' class='fixline btn btn-primary increase-btn'>+</button><br>"
                    + "<button type='button' class='fixbg'><i class='fas fa-trash-alt'></i></button>"
                    + "</p></div></div>"; 
                
                total_price += data[i].pro_price * cart_list[i].quantity;
                total_quantity += cart_list[i].quantity;
            }
            
            // +/-
            html += ' <script> ';
            for(var i in cart_list) {
                html += " $('.decrease-btn').eq(" + i + ").on('click', function() {"
                    + "var quant = parseInt(cart_list[" + i + "].quantity);"
                    + "quant = (quant > 1) ? (quant-1) : 1;"
                    + "cart_list[" + i + "].quantity = quant;"
                    + "sessionStorage.setItem('cart', JSON.stringify(cart_list));"
                    + "window.location.reload();" 
                    + "}); ";
                html += " $('.increase-btn').eq(" + i + ").on('click', function() {"
                    + "var quant = parseInt(cart_list[" + i + "].quantity);"
                    + "quant = (quant == " + data[i].pro_quantity + ") ? quant : (quant+1);"
                    + "cart_list[" + i + "].quantity = quant;"
                    + "sessionStorage.setItem('cart', JSON.stringify(cart_list));"
                    + "window.location.reload();" 
                    + "}); ";
                
            }
            
            // DELETE PRO
            for(var i in cart_list) {
                html += " $('.fa-trash-alt').eq(" + i + ").on('click', function() {"
                    + "cart_list.splice(" + i + ", 1);"
                    + "sessionStorage.setItem('cart', JSON.stringify(cart_list));"
                    + "window.location.reload();"
                    + "}); ";
            }

            html += ' </script> ';
            $("#cart-records").html(html);
            $(".total-price").html(total_price + "$");
            $(".total-quantity").html(total_quantity);
            
            

            // for(var i in cart_list) {
            //     // --
            //     $(".decrease-btn").eq(i).on("click", function() {
            //         var quant = parseInt(cart_list[i].quantity);
            //         quant = (quant>1) ? (quant-1) : 1;
            //         cart_list[i].quantity = quant;
            //         $(".input-number").eq(i).val(quant);      
            //         sessionStorage.setItem('cart', JSON.stringify(cart_list));
                    
            //     });
    
            //     // ++
            //     $(".increase-btn").eq(i).on("click", function() {
            //         var quant = parseInt(cart_list[i].quantity);
            //         quant ++;
            //         cart_list[i].quantity = quant;
            //         $(".input-number").eq(i).val(quant);
            //         sessionStorage.setItem('cart', JSON.stringify(cart_list));
                    
            //     });
            // }





            // $(".decrease-btn").eq(1).on("click", function() {
            //     var quant = parseInt(cart_list[1].quantity);
            //     quant = (quant>1) ? (quant-1) : 1;
            //     cart_list[1].quantity = quant;
            //     $(".input-number").eq(1).val(quant);      
            //     sessionStorage.setItem('cart', JSON.stringify(cart_list));
            // });
            // $(".increase-btn").eq(1).on("click", function() {
            //     var quant = parseInt(cart_list[1].quantity);
            //     quant ++;
            //     cart_list[1].quantity = quant;
            //     $(".input-number").eq(1).val(quant);
            //     sessionStorage.setItem('cart', JSON.stringify(cart_list));
            // });




            
            // SEND ORDER
            $("#click-pay").click(function() {
                // var cart_list = JSON.parse(sessionStorage.getItem('cart'));
                $.ajax({
                    url: "?m=ajax&a=send_order",
                    dataType: "json",
                    type: "POST",
                    data: {
                        cart: cart_list,
                        total_price: total_price
                    }
                });
        
           
            });
        });

     
    }
    else {
        // EMPTY CART
        $("#cart-records").html("<div style='text-align:center'><br>--< EMPTY >--<br><br></div>");
        $(".total-price").html("0$");
        $(".total-quantity").html("0");
        $(".btn-success").attr("disabled", "disabled");
    }


    // ALERT AFTER SEND ORDER
    $("#click-pay").click(function() {
        swal({
            title : "(灬♥ω♥灬) Thank you so much !!", 
            text : "Check your orders in profile~", 
            icon : "success",
            button: "Yee~"
        }).then(function() {
            // CLEAR CART
            sessionStorage.removeItem('cart');
            window.location.reload();
        });
    });



    // CHECK LOGIN TO MODIFY PAY BUTTON
    if(!sessionStorage.getItem('usn')) {
        $("#modal-toggle").attr("data-target","#exampleModal");
    }
    else {
        $("#modal-toggle").attr("data-target","#payModal");
    }

    // FILL BILL
    $("input").keyup(function() {
        $("#cus-name").html($("#a").val());
        $("#cus-phone").html($("#c").val());
        $("#cus-mail").html($("#d").val());
        $("#cus-address").html($("#b").val());
    });
    
    // REQUIRE PAYMENT METHOD
    $("input:radio").change(function() {
        $("#click-pay").prop("disabled", false);
    });
    
});