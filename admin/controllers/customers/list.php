<?php
    $xtp = new XTemplate("{$baseUrl}/admin/views/customers/list.html");

    $sql = "SELECT * FROM tbl_customers WHERE 1 ORDER BY id DESC";
    $arr = $db->fetchAll($sql);

    foreach($arr as $arr_v) {
        $xtp->assign("LOOP", $arr_v);
        $xtp->parse("LIST.LOOP");
    }


    $xtp->assign("baseUrl", $baseUrl);
    $xtp->parse("LIST");
    $content = $xtp->text("LIST");