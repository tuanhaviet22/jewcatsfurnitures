<?php
	$xtp = new XTemplate("{$baseUrl}/views/modules/order_detail.html");
    $id = $_GET['id'];
    $sql = "SELECT 
                P.pro_img,
                P.pro_name,
                OD.pro_quantity,
                P.pro_price
            FROM tbl_products P 
            JOIN tbl_orderdetails OD ON P.id = OD.pro_id
            JOIN tbl_orders O ON O.id = OD.ord_id
            WHERE OD.ord_id = '{$id}'";
    $arr = $db->fetchAll($sql);
    foreach($arr as $rs){
        $rs['baseUrl'] = $baseUrl;
        $xtp -> assign("LOOPS",$rs);
        $xtp -> parse("ORDER_DETAIL.LOOPS");
    }



   $sql = "SELECT 
                O.ord_price AS pro_total_price,
                C.cus_name,
                -- C.cus_address,
                C.cus_phone,
                O.ord_price*OD.pro_quantity + 15 AS total_price
            FROM tbl_products P 
            JOIN tbl_orderdetails OD ON P.id = OD.pro_id
            JOIN tbl_orders O ON O.id = OD.ord_id
            JOIN tbl_customers C ON C.id = O.cus_id
            WHERE OD.id = '{$id}'";
    $arr = $db->fetchOne($sql);
    $xtp->assign("baseUrl", $baseUrl);    
    $xtp->assign("pro_total_price", $arr['pro_total_price']);
    $xtp->assign("cus_name", $arr['cus_name']);
    // $xtp->assign("cus_address", $arr['cus_address']);
    $xtp->assign("cus_phone", $arr['cus_phone']);
    $xtp->assign("total_price", $arr['total_price']);

	$xtp->assign("baseUrl", $baseUrl);
	$xtp->parse("ORDER_DETAIL");
	$contents = $xtp->text("ORDER_DETAIL");