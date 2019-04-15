<?php
    $xtp = new XTemplate("{$baseUrl}/admin/views/orders/list.html");
    

    $sql = "SELECT 
                O.id,
                DATE_FORMAT(O.ord_datetime, '%d/%m/%Y %H:%i:%s') AS ord_datetime,
                O.ord_price,
                O.ord_status,
                C.cus_name
            FROM tbl_orders O JOIN tbl_customers C ON O.cus_id = C.id
            WHERE 1
            ORDER BY O.id DESC";
    
    $arr = $db->fetchAll($sql);

    foreach ($arr as $value) {
        $xtp->assign("LOOP", $value);
        if($value['ord_status'] != -1) {
            $xtp->assign("status_selector", "<div id='{LOOP.id}' class='status'></div>
                <select name='selectorStatus' id='select-{LOOP.id}'>
                <option value='0'>Waiting</option>
                <option value='1'>Done</option>
                </select>");
        }
        else {
            $xtp->assign("status_selector", "<div id='{LOOP.id}' class='status'></div>
                <select name='selectorStatus' id='select-{LOOP.id}' disabled>
                <option value='-1'>Canceled</option>
                </select>");
        }
        $xtp->parse("LIST.LOOP");
    }
    
    $xtp->assign("baseUrl", $baseUrl);

    $xtp->parse("LIST");
    $content = $xtp->text("LIST");
    
    