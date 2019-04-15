<?php
    $xtp = new XTemplate("{$baseUrl}/views/modules/products.html");
//    BRANDS
   $sql1 = "SELECT B.brd_name
                    ,B.id
            FROM tbl_products P
            INNER JOIN tbl_brands B ON B.id = P.brd_id
            GROUP BY B.id";

    $arr1 = $db->fetchAll($sql1);
    
    foreach($arr1 as $l1){
        $arr1["baseUrl"]=$baseUrl;
        $xtp->assign("LIST_BRANDS",$l1);
        $xtp->parse("PRODUCTS.LIST_BRANDS");
    }
   
//    CATEGORIES
    $sql2 = "SELECT * FROM tbl_categories";

    $arr2 = $db->fetchAll($sql2);
    
    foreach($arr2 as $l2){
        $arr2["baseUrl"]=$baseUrl;
        $xtp->assign("LIST_CATEGORIES",$l2);
        $xtp->parse("PRODUCTS.LIST_CATEGORIES");
    }
//  LIST PRODUCTS FOR BRANDS
    if(isset($_GET['brd'])){
        $sql = "SELECT P.pro_img
                        ,P.pro_name
                        ,P.id  
                        ,B.brd_name
                FROM tbl_products P
                INNER JOIN tbl_brands B ON B.id = P.brd_id
                WHERE B.id = {$_GET['brd']} AND P.pro_status = 1";
        $arr = $db->fetchAll($sql);
        $xtp -> assign('title',$arr[0]['brd_name']." products");
        
        foreach($arr as $rs){
            $arr["baseUrl"]=$baseUrl;
            $xtp->assign("LIST_PRODUCTS",$rs);
            $xtp->parse("PRODUCTS.LIST_PRODUCTS");
        }
        
        
        
// LIST PRODUCTS FOR CATEGORIES
    }
    if(isset($_GET['cat'])){
        $sql = "SELECT P.pro_img
                        ,P.pro_name
                        ,P.id  
                        ,C.cat_name
                FROM tbl_products P
                INNER JOIN tbl_categories C ON C.id = P.cat_id
                WHERE C.id = {$_GET['cat']} AND P.pro_status = 1";
        $arr = $db->fetchAll($sql);
        $xtp -> assign('title',$arr[0]['cat_name']);

        foreach($arr as $rs){
            $arr["baseUrl"]=$baseUrl;
            $xtp->assign("LIST_PRODUCTS",$rs);
            $xtp->parse("PRODUCTS.LIST_PRODUCTS");
        }

    }
// LIST ALL PRODUCTS
    if(!isset($_GET['brd']) && !(isset($_GET['cat']))){
        $sql = "SELECT pro_img
                        ,pro_name
                        ,id 
                FROM tbl_products
                WHERE pro_status = 1";
        $arr = $db->fetchAll($sql);

        $xtp -> assign('title', "all products");

        foreach($arr as $rs){
            $arr["baseUrl"]=$baseUrl;
            $xtp->assign("LIST_PRODUCTS",$rs);
            $xtp->parse("PRODUCTS.LIST_PRODUCTS");
        }

    }

    $xtp->assign("baseUrl", $baseUrl);
    $xtp->parse("PRODUCTS");
    $contents = $xtp->text("PRODUCTS");