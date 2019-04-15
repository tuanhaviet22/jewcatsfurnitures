<?php
    if($_POST) {
        date_default_timezone_set("America/New_York");
        $cart_list = $_POST['cart'];
        $cus_id = $_SESSION['CUSTOMERID'];
        $total_price = $_POST['total_price'];
        $ord_id = date("Ymd").time(); // y m d + unix time

        // INSERT TBL ORDER
        $arr = array('id' => $ord_id, 'cus_id' => $cus_id, 'ord_price' => $total_price, 'ord_status' => 0);
        $db->insertOneRecord("tbl_orders", $arr);

        // INSERT TBL ORDERDETAILS
        foreach ($cart_list as $product) {
            $arr = array('ord_id' => $ord_id, 'pro_id' => $product['id'], 'pro_quantity' => $product['quantity']);
            $db->insertOneRecord("tbl_orderdetails", $arr);
        }

        // UPDATE QUANTITY
        foreach ($cart_list as $product) {
            $sql = "SELECT pro_quantity FROM tbl_products WHERE id = '{$product['id']}'";
            $new_quant = intval($db->fetchOne($sql)['pro_quantity']) - intval($product['quantity']);

            if($new_quant != 0) $arr = array('pro_quantity' => $new_quant);
            else $arr = array('pro_quantity' => $new_quant, 'pro_status' => 0);

            $db->updateTbl("tbl_products", $arr, "id = '{$product['id']}'");
        }
        
    }
    exit(0);