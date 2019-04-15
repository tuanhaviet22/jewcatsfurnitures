<?php
	include("../libs/bootstrap.php");

	$xtp = new XTemplate("views/login.html");

	if($_POST) {
		$username = $_POST['txtUsn'];
		$password = md5($_POST['txtPwd']).$salt;

		$sql = "SELECT * FROM tbl_accounts WHERE acc_pwd = '{$password}' AND acc_usn = '{$username}'";

		$arr = $db->fetchOne($sql);
		

		if(strlen($arr['acc_usn']) != 0) {
			$_SESSION['USERNAME'] = $arr['acc_usn'];
			$_SESSION['ROLE'] = $arr['acc_role'];
            header("location: {$baseUrl}/admin/?m=products&a=list");
		}
		else {
			$msg = "*Account doesn't exist or incorrect password";
			$xtp->assign("msg", $msg);
		}
	}

	$xtp->assign("baseUrl", $baseUrl);
	$xtp->parse("LOGIN");
	$xtp->out("LOGIN");
