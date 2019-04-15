<?php   
	if($_POST){
        $usn = $_SESSION['CUSTOMERNAME'];
        $sql = "SELECT * FROM tbl_customers 
                WHERE cus_usn = '$usn'";
        $arr = $db -> fetchOne($sql);
        $pwd = $arr['cus_pwd'];
        $id = $arr['id'];
        $name = $_POST['txtName'];
        $email = $_POST['txtEmail'];
        $phone = $_POST['txtTel'];
        $cus_pwd = md5($_POST['txtPw']).$salt;
        $cus_repwd = md5($_POST['txtRpw']).$salt;
        $checkpass = md5($_POST['txtPass']).$salt;
        if($checkpass==$pwd && $cus_pwd == $cus_repwd && strlen($cus_pwd) > 0  && strlen($cus_repwd) > 0){
            $arr1 = array(
                "cus_name" => $name, 
                "cus_mail" => $email,
                "cus_phone" => $phone,
                "cus_pwd" => $cus_pwd
            );
            $db -> updateTbl('tbl_customers',$arr1,"id = '{$id}'");
            echo json_encode('');	
        }else{
			echo json_encode('errors');			
        }        
	}	
	exit(0);