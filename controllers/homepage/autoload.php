<?php
	$xtp = new XTemplate("{$baseUrl}/views/autoload.html");
//        data for product recomendations
        $sql = "SELECT P.id,P.pro_name,P.pro_img,B.brd_name FROM tbl_products P 
                INNER JOIN tbl_brands B ON B.id=P.brd_id
                WHERE pro_status = 1
                GROUP BY P.pro_img DESC
                LIMIT 12";
        $rs = $db->fetchAll($sql);
        foreach ($rs as $p){
                $p['baseUrl'] = $baseUrl;
                $xtp->assign('RECOMENDLOOP', $p);
                $xtp->parse("HOMEPAGE.RECOMENDLOOP");
        }
//        data for the office
        $sql1 ="SELECT P.id,P.pro_name,P.pro_img,C.cat_name FROM tbl_products P 
                INNER JOIN tbl_categories C ON C.id=P.cat_id
                WHERE pro_status = 1 AND C.cat_name='Chairs & Sofas' OR C.cat_name='Tables & Desks'
                GROUP BY P.pro_price ASC
                LIMIT 4";
        $rs1 = $db->fetchALl($sql1);
        foreach($rs1 as $p1){
            $p1['baseUrl']= $baseUrl;
            $xtp->assign('OFFICELOOP',$p1);
            $xtp->parse('HOMEPAGE.OFFICELOOP');
        }
//        data for home
        $sql2="SELECT P.id,P.pro_name,P.pro_img,C.cat_name FROM tbl_products P 
                INNER JOIN tbl_categories C ON C.id=P.cat_id
                WHERE pro_status = 1 AND C.cat_name='Sinks & Bathtubs' OR C.cat_name='Storages' OR C.cat_name='Beds'
                GROUP BY P.pro_price DESC
                LIMIT 4";
        $rs2 = $db->fetchAll($sql2);
        foreach($rs2 as $p2){
            $p2['baseUrl'] = $baseUrl;
            $xtp->assign('HOMELOOP',$p2);
            $xtp->parse('HOMEPAGE.HOMELOOP');
        }
	$xtp->assign("baseUrl", $baseUrl);
	$xtp->parse("HOMEPAGE");
	$contents = $xtp->text("HOMEPAGE");