<?php   
	if($_POST){
		$username = $_POST['txtUsn'];
		$password = md5($_POST['txtPw']).$salt;

		$sql = "SELECT * FROM tbl_customers WHERE cus_pwd = '{$password}' AND cus_usn = '{$username}'";

		$arr = $db->fetchOne($sql);

		if(strlen($arr['cus_usn']) > 0) {
			$_SESSION['CUSTOMERNAME'] = $arr['cus_usn'];
			$_SESSION['CUSTOMERID'] = $arr['id'];
			echo json_encode(array('cus_usn' => $arr['cus_usn'], 'errors' => '', 'cus_name' => $arr['cus_name']));
		}
		else { 	
			echo json_encode(array('cus_usn' => '', 'errors' => "Account doesn't exist or incorrect password"));		
		}
	}	
	exit(0);