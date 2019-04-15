<?php
    $xtp = new XTemplate("{$baseUrl}/admin/views/products/list.html");

    // search-box by brand
    $arr = $db->fetchAll("SELECT id, brd_name FROM tbl_brands WHERE 1");
    $xtp->assign("selectorBrand", $db->getSelector($arr, "selectorBrand", -1));

    // search-box by category
    $arr = $db->fetchAll("SELECT id, cat_name FROM tbl_categories WHERE 1");
    $xtp->assign("selectorCategory", $db->getSelector($arr, "selectorCategory", -1));

    // products list
    $sql = "SELECT 
        P.id, 
        pro_name, 
        pro_price, 
        pro_img, 
        pro_quantity,  
        pro_status,
        brd_name, 
        cat_name
    FROM tbl_products P
    JOIN tbl_categories C ON P.cat_id = C.id
    JOIN tbl_brands B ON P.brd_id = B.id
    WHERE 1
    ORDER BY P.id DESC";
	$arr = $db->fetchAll($sql);

	foreach ($arr as $value) {
		$xtp->assign("LOOP", $value);
		$xtp->assign("baseUrl", $baseUrl);

		$xtp->parse("LIST.LOOP");
	}


    $xtp->assign("baseUrl", $baseUrl);
    $xtp->parse("LIST");
    $content = $xtp->text("LIST");