<?php
    if($_POST){
        $cus_name = $_POST['txtFullName'];
        $cus_usn = $_POST['txtUsr'];
        $cus_pwd = md5($_POST['txtPass']).$salt;
        $cus_repwd = md5($_POST['txtRepw']).$salt;
        $cus_phone = $_POST['txtTel'];
        $cus_mail = $_POST['txtEmail'];

        $sql="SELECT * FROM tbl_customers WHERE cus_usn ='{$cus_usn}'";
        $arr = $db->fetchOne($sql);
        
        if(strlen($arr['cus_usn']) == 0 && $cus_pwd == $cus_repwd && strlen($cus_usn) > 0 && strlen($cus_pwd) > 0  && strlen($cus_repwd) > 0)
        {    
            $arr = array(
                "cus_name" => $cus_name, 
                "cus_usn" => $cus_usn,
                "cus_pwd" => $cus_pwd,
                "cus_phone" => $cus_phone,
                "cus_mail" => $cus_mail
            );   

            $db->insertOneRecord("tbl_customers", $arr);
			echo json_encode('');		            
        }
        else{
			echo json_encode('errors');		            
        }
    }
    exit(0);