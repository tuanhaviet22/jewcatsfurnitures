<?php
    $xtp = new XTemplate("{$baseUrl}/views/modules/profile.html");
    
    // Show cus info
    $usn = $_SESSION['CUSTOMERNAME'];
    $sql = "SELECT * FROM tbl_customers 
            WHERE cus_usn = '$usn'";
    $arr = $db -> fetchOne($sql);
    $id = $arr['id'];
    $pwd = $arr['cus_pwd'];
    $xtp->assign("cus_name", $arr['cus_name']);
    $xtp->assign("cus_usn", $arr['cus_usn']);
    $xtp->assign("cus_mail", $arr['cus_mail']);
    $xtp->assign("cus_phone", $arr['cus_phone']);
    $xtp->assign("cus_address", $arr['cus_address']);

    // Show orders list
    $sql = "SELECT DATE_FORMAT(O.ord_datetime, '%d/%m/%Y %H:%i:%s') AS ord_datetime,
            O.ord_price AS total_price,
            O.ord_status,
            O.id
        FROM tbl_orders O
        WHERE O.cus_id = {$id} AND O.ord_status != -1";
    $arr = $db->fetchAll($sql);

    if(count($arr) > 0) {
        $ord_id=$arr[0]['id'];
        $ord_status = $arr[0]['ord_status'];
        foreach($arr as $rs){
            if($rs['ord_status']==0) $rs['ord_status']="Waiting";
            else  if($rs['ord_status']==1) $rs['ord_status']="Done";
            // else $rs['ord_status']="Canceled";
            $xtp -> assign("LOOP",$rs);
            $xtp -> parse("PROFILE.LOOP");
        }
    }

    $xtp->assign("baseUrl", $baseUrl);
    $xtp -> parse("PROFILE");
    $contents = $xtp ->text("PROFILE"); 
