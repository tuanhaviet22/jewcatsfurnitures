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
        $checkpass = md5($_POST['txtPass']).$salt;
        if($checkpass==$pwd){
            $arr1 = array(
                "cus_name" => $name, 
                "cus_mail" => $email,
                "cus_phone" => $phone,
            );
            $db -> updateTbl('tbl_customers',$arr1,"id = '{$id}'");
            echo json_encode('');	
        }else{
			echo json_encode('errors');			
        }        
	}	
	exit(0);