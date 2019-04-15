<?php
	if($_POST) {
		$search = trim($_POST['search']);
		//$search = '%'.$search.'%';
		
		$sql = "SELECT P.id, 
			P.pro_name, 
			P.pro_price,
			P.pro_img,
			P.pro_quantity,
			B.brd_name,
			C.cat_name
			FROM tbl_products P INNER JOIN tbl_brands B ON P.brd_id = B.id
			INNER JOIN tbl_categories C ON C.id = P.cat_id
			WHERE 1=1 AND (P.id LIKE '%{$search}%'
			OR P.pro_name LIKE '%{$search}%'
			OR P.pro_price LIKE '%{$search}%'
			OR B.brd_name LIKE '%{$search}%'
			OR C.cat_name LIKE '%{$search}%')
			ORDER BY P.id DESC";
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
	