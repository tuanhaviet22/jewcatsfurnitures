<?php
if($_SESSION['ROLE'] <= 2) {
    $xtp = new XTemplate("{$baseUrl}/admin/views/accounts/delete.html");

    if($_POST) {
        $pwd = md5($_POST['txtPwd']).$salt;
        $id = $_GET['id'];
        
        // check password and role -> del acc
        $sql = "SELECT * FROM tbl_accounts WHERE acc_usn = '{$_SESSION['USERNAME']}'";
        $arr = $db->fetchOne($sql);

        if($pwd == $arr['acc_pwd']) {
            $sql = "SELECT * FROM tbl_accounts WHERE id = '{$id}'";
            $arr = $db->fetchOne($sql);
            
            //if role < admin & user == admin -> del acc
            if($_SESSION['ROLE'] == 2) {
                if($arr['acc_role'] > 2) {
                    $db->delRecord("tbl_accounts", "id = {$id}");
                    header("Location: ?m=accounts&a=list");
                }
                else {
                    $msg = "Cannot delete admin's account";
                }
            }
            //if role < owner & user == owner -> del acc
            else {
                if($arr['acc_role'] > 1 ) {
                    $db->delRecord("tbl_accounts", "id = {$id}");
                    header("Location: ?m=accounts&a=list");
                }
                else {
                    $msg = "Cannot delete owner's account";
                }
            }
                
        }
        else {
            $msg = "Password incorrect";
        }

        $xtp->assign("msg", $msg);
    }

    $xtp->assign("baseUrl", $baseUrl);
    $xtp->parse("DELETE");
    $content = $xtp->text("DELETE");
}
else {
    $content =  "You are not competent!";
}


