$(document).ready(function() {  
    function getIndexFromURL(url, index) {
        var id = '';
        for(var i = parseInt(url.indexOf(index)) + index.length + 1; i < url.length; i++) {
            if(url[i] != '&') id += url[i];
            else break;
        }
        return id;
    }

    function isAvailablePro(object, proid) {
        var flag = false;
        for(var i in object) {
            if(object[i].id == proid) {
                flag = true;
                break;
            }
        }

        return flag;
    }

    function increaseProQuantity(object, proid) {
        for(var i in object) {
            if(object[i].id == proid) {
                object[i].quantity ++;
                break;
            }
        }
    }

    $("#eat-me-sempai").click(function() {
        // GET AVAILABLE DATA || CREATE NEW CART LIST
        if(sessionStorage.cart) {
            cart_list = JSON.parse(sessionStorage.getItem('cart'));

            // IF AVAILABLE PRODUCT -> QUANTITY ++ ELSE ADD NEW PRODUCT
            if(!isAvailablePro(cart_list, getIndexFromURL($(location).attr('href'), 'id'))) {
                var product = new Object();
                product.id = getIndexFromURL($(location).attr('href'), 'id');
                product.quantity = 1;
    
                cart_list.push(product);
            }
            else {
                increaseProQuantity(cart_list, getIndexFromURL($(location).attr('href'), 'id'));
            }
        }
        else {
            cart_list = [];
            var product = new Object();
            product.id = getIndexFromURL($(location).attr('href'), 'id');
            product.quantity = 1;

            cart_list.push(product);
        }

        
        
            
        // -> SESSION STORAGE
        
        sessionStorage.setItem('cart', JSON.stringify(cart_list));
        

        // ALERT
        swal({
            title : "( ˶˘ ³˘(˵ ͡° ͜ʖ ͡°˵)♡", 
            text : "This product has been sent to your cart" , 
            icon : "success",
            button: "Okk!" ,
        });
    });

});