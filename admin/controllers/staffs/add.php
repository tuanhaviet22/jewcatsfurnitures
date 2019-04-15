<?php
    $xtp = new XTemplate("{$baseUrl}/admin/views/staffs/add.html");

    if($_POST) {
        // get data
        $name = $_POST['txtName'];
        $role = $_POST['txtRole'];
        $phone = $_POST['txtPhone'];
        $sal = $_POST['txtSal'];
        
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

        // send data to database
        if($flag != 0) {
            $arr = array("stf_name" => $name, "stf_role" => $role, "stf_phone" => $phone, "stf_salary" => $sal, "stf_status" => 1);
            $db->insertOneRecord("tbl_staffs", $arr);
            $msg = "Successful!";
        }
    }

    if($_POST) $xtp->assign("msg", $msg);
    $xtp->assign("baseUrl", $baseUrl);
    $xtp->parse("ADD");
    $content = $xtp->text("ADD");