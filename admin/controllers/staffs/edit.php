<?php
    $xtp = new XTemplate("{$baseUrl}/admin/views/staffs/edit.html");
    $id = $_GET['id'];

    
    // get old data
    $sql = "SELECT * FROM tbl_staffs WHERE id = '{$id}'";
    $arr = $db->fetchOne($sql);
    
    $xtp->assign("oldName", $arr['stf_name']);
    $xtp->assign("oldRole", $arr['stf_role']);
    $xtp->assign("oldPhone", $arr['stf_phone']);
    $xtp->assign("oldSal", $arr['stf_salary']);

    $status_arr = array(
        array("0" => 0, "1" => "Inactive"),
        array("0" => 1, "1" => "Active"),
        array("0" => 2, "1" => "Absent")
    );
    $xtp->assign("selectorBox", $db->getSelector($status_arr, "selectStatus", $arr['stf_status']));


    if($_POST) {
        // get data
        $name = $_POST['txtName'];
        $role = $_POST['txtRole'];
        $phone = $_POST['txtPhone'];
        $sal = $_POST['txtSal'];
        $status = $_POST['selectStatus'];

        //validate
        $flag = 1;
        $msg = "";
        if(!$valid->isNumber($phone)) {
            $flag = 0;
            $msg .= "invalid phone number. ";
        } 
        if(!$valid->isText($name)) {
            $flag = 0;
            $msg .= "invalid name. ";
        } 
        if(!$valid->isNumber($sal)) {
            $flag = 0;
            $msg .= "invalid salary. ";
        } 
        if($status == -1) {
            $flag = 0;
            $msg .= "choose 1 status. ";
        }
        
        // update data to database
        if($flag != 0) {
            $arr = array("stf_name" => $name, "stf_role" => $role, "stf_phone" => $phone, "stf_salary" => $sal, "stf_status" => $status);
            $db->updateTbl("tbl_staffs", $arr, "id = '{$id}'");
            header("Location: ?m=staffs&a=list");
        }
    }

    if($_POST) $xtp->assign("msg", $msg);
    $xtp->assign("baseUrl", $baseUrl);
    $xtp->parse("EDIT");
    $content = $xtp->text("EDIT");
    

    
    
    
    
    