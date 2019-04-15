<?php
	if($_SESSION['ROLE'] <= 3) {
		$xtp = new XTemplate("{$baseUrl}/admin/views/brands/add.html");

		if($_POST) {
			// get data
			$name = $_POST['txtName'];
			$fname = $_FILES['txtFileLocation']['name'];

			//validate
			$flag = 1;
			$sql = "SELECT * FROM tbl_brands WHERE brd_name = '{$name}' OR brd_logo = '{$fname}'";
			$arr = $db->fetchOne($sql);
			if(strlen($arr['brd_name']) > 0) $flag = 0;

			// upload logo to server
			if($flag != 0) {
				$arr_ext = array("jpg", "jpeg", "png", "gif");
				$maxsize = 4000000;
				$url = "./images/brands/";
				$errors = $f->uploadFile($_FILES['txtFileLocation'], $url, $arr_ext, $maxsize);
				if(strlen($errors) > 0) $flag = 0;
			}

			// send data to database
			if($flag != 0) {
				$arr = array("brd_name" => $name, "brd_logo" => $fname);
				$db->insertOneRecord("tbl_brands", $arr);
				$msg = "Successful!";
			}
			else {
				$msg = "Failed! (brand exists or file uploaded exists, is greater than 4MB or has extension incorrect)";
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