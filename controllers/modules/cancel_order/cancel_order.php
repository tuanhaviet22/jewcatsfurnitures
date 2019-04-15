<?php
    $id = $_GET['id'];

    $sql = "SELECT * FROM tbl_orders WHERE id = {$id}";
    $arr = $db -> fetchOne($sql);

    if($arr['ord_status'] == 0){
        // UPDATE STATUS
        $stt = array(
            "ord_status" => "-1" 
        );
        $db -> updateTbl('tbl_orders', $stt, "id = {$id}");
        
        // UPDATE PRODUCTS QUANTITY
        $sql = "SELECT * FROM tbl_orderdetails WHERE ord_id = '{$id}'";
        $arr = $db->fetchAll($sql);
        foreach($arr as $arrv) {
            $old_quant = $db->fetchOne("SELECT pro_quantity FROM tbl_products WHERE id = '{$arrv['pro_id']}'")['pro_quantity'];
            $pro = array('pro_quantity' => $old_quant + $arrv['pro_quantity']);
            $db->updateTbl("tbl_products", $pro, "id = '{$arrv['pro_id']}'");
        }

        header("location: ?m=profile&a=profile");
    }
    
    
