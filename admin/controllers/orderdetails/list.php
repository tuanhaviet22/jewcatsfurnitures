<?php
    $xtp = new XTemplate("{$baseUrl}/admin/views/orderdetails/list.html");
    
    $id = $_GET['id'];

    // top-tbl
    $sql = "SELECT 
                DATE_FORMAT(O.ord_datetime, '%d/%m/%Y %H:%i:%s') AS ord_datetime,
                O.ord_price,
                C.cus_name
            FROM tbl_orders O JOIN tbl_customers C ON O.cus_id = C.id
            WHERE O.id = '{$id}'";
    
    $arr = $db->fetchOne($sql);

    $xtp->assign("dateTime", $arr['ord_datetime']);
    $xtp->assign("cusName", $arr['cus_name']);
    $xtp->assign("totalPrice", $arr['ord_price']);

    // bottom-tbl
    $sql = "SELECT 
                OD.id,
                P.pro_name,
                P.pro_price,
                OD.pro_quantity,
                B.brd_name,
                C.cat_name
            FROM tbl_products P 
            JOIN tbl_orderdetails OD ON P.id = OD.pro_id
            JOIN tbl_orders O ON O.id = OD.ord_id
            JOIN tbl_brands B ON B.id = P.brd_id
            JOIN tbl_categories C ON C.id = P.cat_id
            WHERE O.id = '{$id}'";
    
    $arr = $db->fetchAll($sql);

    foreach ($arr as $value) {
        $xtp->assign("LOOP", $value);
        $xtp->parse("LIST.LOOP");
    }
    
    $xtp->assign("baseUrl", $baseUrl);

    $xtp->parse("LIST");
    $content = $xtp->text("LIST");
    
    