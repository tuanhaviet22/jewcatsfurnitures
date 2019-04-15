<?php
	if($_SESSION['ROLE'] <= 3) {
		$xtp = new XTemplate("{$baseUrl}/admin/views/categories/add.html");

		if($_POST) {
			// get data
			$name = $_POST['txtName'];

			//validate
			$flag = 1;
			$sql = "SELECT * FROM tbl_categories WHERE cat_name = '{$name}'";
			$arr = $db->fetchOne($sql);
			if(strlen($arr['cat_name']) > 0) $flag = 0;

			// send data to database
			if($flag != 0) {
				$arr = array("cat_name" => $name);
				$db->insertOneRecord("tbl_categories", $arr);
				$msg = "Successful!";
			}
			else {
				$msg = "Failed! (category exists)";
			}
		}

		if($_POST) $xtp->assign("msg", $msg);
		$xtp->assign("baseUrl", $baseUrl);
		$xtp->parse("ADD");
		$content = $xtp->text("ADD");
	}
	else {
		$content =  "You are not competent!";
	}