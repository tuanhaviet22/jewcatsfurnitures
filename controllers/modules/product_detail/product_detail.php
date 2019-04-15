<?php
	$xtp = new XTemplate("{$baseUrl}/views/modules/product_detail.html");
        $id = $_GET['id'];
        $sql = "SELECT P.pro_name
			,P.pro_description
			,P.pro_img
			,P.pro_price
                        ,P.cat_id
                        ,P.pro_quantity
			,C.cat_name FROM tbl_products P
		INNER JOIN tbl_categories C ON C.id=P.cat_id 
		WHERE P.id = '{$id}'";
        $arr = $db->fetchOne($sql);
	$arr['baseUrl'] = $baseUrl;
	$xtp->assign($arr,'PRODUCT_DETAIL');
        
        
        $cat_id_cmp = $arr['cat_id'];
        $pro_price_cmp = $arr['pro_price'];

	//        data for same products
        $sql1 = "SELECT P.id,P.pro_name,P.pro_img,P.pro_price FROM tbl_products P 
                INNER JOIN tbl_categories C ON C.id=P.cat_id
                WHERE pro_status = 1 
                AND C.id = $cat_id_cmp 
                AND ABS(P.pro_price-$pro_price_cmp)<=50
                AND P.id != {$id}
                GROUP BY P.pro_img DESC
                ";
        $rs = $db->fetchAll($sql1);
        foreach ($rs as $p){
                $p['baseUrl'] = $baseUrl;
                $xtp->assign('SAME_PRODUCTS', $p);
                $xtp->parse("PRODUCT_DETAIL.SAME_PRODUCTS");
        }


        // modals
        foreach ($rs as $p){
                $p['baseUrl'] = $baseUrl;
                $xtp->assign('MODAL_LOOP', $p);
                
                $xtp->assign('cmp_pro_img', $arr['pro_img']);
                $xtp->assign('cmp_pro_name', $arr['pro_name']);
                $xtp->assign('cmp_pro_price', $arr['pro_price']);

                $xtp->parse("PRODUCT_DETAIL.MODAL_LOOP");
        }






	$xtp->assign("baseUrl", $baseUrl);
	$xtp->parse("PRODUCT_DETAIL");
	$contents = $xtp->text("PRODUCT_DETAIL");