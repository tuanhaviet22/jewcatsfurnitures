<?php
    $xtp= new XTemplate("{$baseUrl}/admin/views/productdetails/list.html");
    $id = $_GET['id'];

    $sql = "SELECT 
        P.id, 
        pro_name, 
        pro_price, 
        pro_img, 
        pro_quantity,  
        pro_description,
        pro_status,
        brd_name, 
        cat_name
    FROM tbl_products P
    JOIN tbl_categories C ON P.cat_id = C.id
    JOIN tbl_brands B ON P.brd_id = B.id
    WHERE P.id = {$id}";
    $arr = $db->fetchOne($sql);

    $xtp->assign("LS", $arr);
    $xtp->parse("LIST.LS");

    $xtp->assign('baseUrl', $baseUrl);
    $xtp->parse('LIST');
    $content = $xtp->text('LIST');