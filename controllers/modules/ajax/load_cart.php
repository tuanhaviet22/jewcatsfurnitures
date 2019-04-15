<?php
    if($_POST) {
        $arrid = "(".implode(',', $_POST['arrid']).")";

        $sql = "SELECT pro_name, pro_price, pro_img, pro_quantity FROM tbl_products WHERE id IN {$arrid}";
        $arr = $db->fetchAll($sql);
        for($i = 0; $i < count($arr); $i++) $arr[$i]['baseUrl'] = $baseUrl;

       
        echo json_encode($arr);
    }
    exit(0);