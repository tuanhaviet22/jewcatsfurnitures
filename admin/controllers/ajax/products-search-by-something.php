<?php
    if($_POST) {
        $brand = $_POST['searchB'];
        $category = $_POST['searchC'];

        if($brand == -1 && $category > 0) {
            $sql = "SELECT P.id, 
                P.pro_name, 
                P.pro_price,
                P.pro_img,
                P.pro_quantity,
                B.brd_name,
                C.cat_name
                FROM tbl_products P INNER JOIN tbl_brands B ON P.brd_id = B.id
                INNER JOIN tbl_categories C ON C.id = P.cat_id
                WHERE C.id = {$category}
                ORDER BY P.id DESC";
        }

        if($brand > 0 && $category == -1) {
            $sql = "SELECT P.id, 
                P.pro_name, 
                P.pro_price,
                P.pro_img,
                P.pro_quantity,
                B.brd_name,
                C.cat_name
                FROM tbl_products P INNER JOIN tbl_brands B ON P.brd_id = B.id
                INNER JOIN tbl_categories C ON C.id = P.cat_id
                WHERE B.id = {$brand}
                ORDER BY P.id DESC";
        }

        if($brand == -1 && $category == -1) {
            $sql = "SELECT P.id, 
                P.pro_name, 
                P.pro_price,
                P.pro_img,
                P.pro_quantity,
                B.brd_name,
                C.cat_name
                FROM tbl_products P INNER JOIN tbl_brands B ON P.brd_id = B.id
                INNER JOIN tbl_categories C ON C.id = P.cat_id
                WHERE 1
                ORDER BY P.id DESC";
        }

        if($brand > 0 && $category > 0) {
            $sql = "SELECT P.id, 
                P.pro_name, 
                P.pro_price,
                P.pro_img,
                P.pro_quantity,
                B.brd_name,
                C.cat_name
                FROM tbl_products P INNER JOIN tbl_brands B ON P.brd_id = B.id
                INNER JOIN tbl_categories C ON C.id = P.cat_id
                WHERE B.id = {$brand} AND C.id = {$category}
                ORDER BY P.id DESC";
        }
        
        $arr = $db->fetchAll($sql);
        
        if(count($arr) > 0) {
			$data = array('records' => $arr, 'baseUrl' => $baseUrl);
			echo json_encode($data);
		}
		else {
			echo json_encode("");
		}
    }
    exit(0);