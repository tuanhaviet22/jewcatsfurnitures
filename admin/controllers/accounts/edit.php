<?php
    $xtp = new XTemplate("{$baseUrl}/admin/views/accounts/edit.html");
    $id = $_GET['id'];

    $sql = "SELECT * FROM tbl_accounts WHERE id = '{$id}'";
    $arr = $db->fetchOne($sql);

    if($_SESSION['USERNAME'] == $arr['acc_usn']) {
        // get old data
        $sql = "SELECT * FROM tbl_accounts WHERE id = '{$id}'";
        $arr = $db->fetchOne($sql);
        $old_pwd = $arr['acc_pwd'];
        $xtp->assign("oldName", $arr['acc_usn']);
        
        if($_POST) {
            // validate
            $flag = 1;

            // check old password
            if($old_pwd != md5($_POST['txtOldPwd']).$salt) $flag = 0;

            // confirmed password & password
            if($_POST['txtPwd'] == $_POST['txtCnfPwd']) $pwd = md5($_POST['txtPwd']).$salt;
            else $flag = 0;
            
            // update data to database
            if($flag != 0) {
                $arr = array("acc_pwd" => $pwd);
                $db->updateTbl("tbl_accounts", $arr, "id = '{$id}'");
                header("location: {$baseUrl}/admin/logout.php");
            }
            else {
                $msg = "Failed! (incorrect old password or your retyped password is invalid)";
            }

            
        }

        if($_POST) $xtp->assign("msg", $msg);
        $xtp->assign("baseUrl", $baseUrl);
        $xtp->parse("EDIT");
        $content = $xtp->text("EDIT");
    }
    else {
        $content =  "You are not competent!";
    }

    
    
    
    
    