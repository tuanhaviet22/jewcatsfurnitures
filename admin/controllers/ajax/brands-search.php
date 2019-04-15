<?php
	if($_POST) {
		$search = trim($_POST['search']);

		$sql = "SELECT * FROM tbl_brands WHERE brd_name LIKE '%{$search}%' ORDER BY id DESC";
		$arr = $db->fetchAll($sql);
		
		if(count($arr) > 0) {
			$data = array('records' => $arr,'baseUrl' => $baseUrl);
			echo json_encode($data);
		} 
		else echo json_encode("");
	}
	exit(0);
	