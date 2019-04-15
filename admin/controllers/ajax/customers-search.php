<?php
	if($_POST) {
		$search = trim($_POST['search']);

		$sql = "SELECT id, cus_name, cus_usn, cus_phone, cus_mail 
            FROM tbl_customers 
            WHERE cus_name LIKE '%{$search}%' 
            OR cus_usn LIKE '%{$search}%' 
            OR cus_phone LIKE '%{$search}%'
            OR cus_mail LIKE '%{$search}%'
		OR id LIKE '%{$search}%'
		ORDER BY id DESC";
		$arr = $db->fetchAll($sql);
        
		if(count($arr) > 0) echo json_encode($arr);
		else echo json_encode("");
	}
	exit(0);
	