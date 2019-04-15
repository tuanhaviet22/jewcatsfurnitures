<?php
    $xtp = new XTemplate("{$baseUrl}/admin/views/accounts/list.html");
    

    if($_SESSION['ROLE'] == 1) $sql = "SELECT * FROM tbl_accounts WHERE 1";
    if($_SESSION['ROLE'] == 2) $sql = "SELECT * FROM tbl_accounts WHERE acc_role > 1";
    if($_SESSION['ROLE'] > 2) $sql = "SELECT * FROM tbl_accounts WHERE acc_usn = '{$_SESSION['USERNAME']}'";
    
    $arr = $db->fetchAll($sql);

    foreach ($arr as $value) {
        $xtp->assign("LOOP", $value);

        // role
        switch($value['acc_role']) {
            case '1': $role = "owner"; break;
            case '2': $role = "admin"; break;
            case '3': $role = "mod"; break;
            case '4': $role = "staff"; break;
        }
        $xtp->assign("role", $role);

        // staff name
        $sql = "SELECT stf_name FROM tbl_staffs 
            JOIN tbl_accounts ON tbl_staffs.id = tbl_accounts.stf_id
            WHERE tbl_accounts.id = '{$value['id']}'";
        $stf_name = $db->fetchOne($sql)['stf_name'];
        $xtp->assign("stfname", $stf_name);

        $xtp->parse("LIST.LOOP");
    }
    
    $xtp->assign("baseUrl", $baseUrl);

    $xtp->parse("LIST");
    $content = $xtp->text("LIST");
    
    