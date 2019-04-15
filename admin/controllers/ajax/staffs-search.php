<?php
	if($_POST) {
		$search = trim($_POST['search']);

		$sql = "SELECT * FROM tbl_staffs 
            WHERE stf_name LIKE '%{$search}%' 
            OR stf_role LIKE '%{$search}%' 
            OR id LIKE '%{$search}%'
            OR stf_phone LIKE '%{$search}%'
            ORDER BY id DESC";
		$arr = $db->fetchAll($sql);
        
		if(count($arr) > 0) {
            $i = 0;
            foreach ($arr as $value) {
                switch($value['stf_status']) {
                    case 0: $status = "Inactive"; break;
                    case 1: $status = "Active"; break;
                    case 2: $status = "Absent"; break;
                }
                $arr[$i]['stf_status'] = $status;
                $i++;
            }
			
			echo json_encode($arr);
		} 
		else echo json_encode("");
	}
	exit(0);
	