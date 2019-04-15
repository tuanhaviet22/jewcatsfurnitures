<?php
	if($_POST) {
		$search = trim($_POST['search']);

		$sql = "SELECT 
                    O.id,
                    DATE_FORMAT(O.ord_datetime, '%d/%m/%Y %H:%i:%s') AS ord_datetime,
                    O.ord_price,
                    S.stf_name,
                    C.cus_name
                FROM tbl_orders O JOIN tbl_customers C ON O.cus_id = C.id
                JOIN tbl_staffs S ON S.id = O.stf_id
                WHERE O.id LIKE '%{$search}%' 
                OR O.ord_datetime LIKE '%{$search}%' 
                OR O.ord_price LIKE '%{$search}%'
                OR S.stf_name LIKE '%{$search}%'
                OR C.cus_name LIKE '%{$search}%'
                ORDER BY O.id DESC";
                
		$arr = $db->fetchAll($sql);
        
		if(count($arr) > 0) echo json_encode($arr);
		else echo json_encode("");
	}
	exit(0);
	