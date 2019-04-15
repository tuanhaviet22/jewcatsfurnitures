<?php
    if($_SESSION['ROLE'] <= 2) {
        $xtp = new XTemplate("{$baseUrl}/admin/views/accounts/add.html");

        // get selector for role
        if($_SESSION['ROLE'] == 1) {
            $arr_role = array(
                array(1, "owner"),
                array(2, "admin"),
                array(3, "mod"),
                array(4, "staff")
            );
        }
        else {
            $arr_role = array(
                array(3, "mod"),
                array(4, "staff")
            );
        }
        
        $xtp->assign("selectBox", $db->getSelector($arr_role, "roleSelector", -1));

        if($_POST) {
            // get data
            $usn = $_POST['txtUsn'];
            $pwd = md5($_POST['txtPwd']).$salt;
            $role = $_POST['roleSelector'];
            $staff_id = $_POST['txtStfId'];

            //validate
            $flag = 1;
            $sql = "SELECT * FROM tbl_accounts WHERE acc_usn = '{$usn}'";
            $arr = $db->fetchOne($sql);
            if(strlen($arr['acc_usn']) > 0) $flag = 0;
            if($role < 0) $flag = 0;


            // send data to database
            if($flag != 0) {
                $arr = array("acc_usn" => $usn, "acc_pwd" => $pwd, "acc_role" => $role, "stf_id" => $staff_id);
                $db->insertOneRecord("tbl_accounts", $arr);
                $msg = "Successful!";
            }
            else {
                $msg = "Failed! (account exists or invalid role)";
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