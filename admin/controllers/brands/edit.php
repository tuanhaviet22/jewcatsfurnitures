<?php
    if($_SESSION['ROLE'] <= 3) {
        $xtp = new XTemplate("{$baseUrl}/admin/views/brands/edit.html");
        $id = $_GET['id'];

        // get old data
        $sql = "SELECT * FROM tbl_brands WHERE id = '{$id}'";
        $arr = $db->fetchOne($sql);
        $xtp->assign("oldName", $arr['brd_name']);
        $old_logo = $arr['brd_logo'];

        
        if($_POST) {
            // validate
            $name = $_POST['txtName'];
            $fname = $_FILES['txtFileLocation']['name'];

            $flag = 1;
            $sql = "SELECT * FROM tbl_brands WHERE brd_name = '{$name}' AND id != '{$id}'";
            $arr = $db->fetchOne($sql);
            if(strlen($arr['brd_name']) > 0) $flag = 0; 
        
            
            // del old logo & upload logo to server
            if($_FILES['txtFileLocation']['name'] != "" && $flag != 0) {
                unlink("./images/brands/{$old_logo}");
                $arr_ext = array("jpg", "jpeg", "png", "gif");
                $maxsize = 4000000;
                $url = "./images/brands/";
                $errors = $f->uploadFile($_FILES['txtFileLocation'], $url, $arr_ext, $maxsize);
                if(strlen($errors) > 0) $flag = 0;
            }
            
            // update data to database and unlink old logo if success
            if($flag != 0) {
                if($_FILES['txtFileLocation']['name'] != "") $arr = array("brd_name" => $name, "brd_logo" => $fname);
                else $arr = array("brd_name" => $name);

                $db->updateTbl("tbl_brands", $arr, "id = '{$id}'");
                
                $msg = "Successful!";
            }
            else {
                $msg = "Failed! (brand exists or file uploaded is greater than 4MB or has extension incorrect)";
            }

            // reload
            header("Location: ?m=products&a=edit&id={$id}");
        }

        if($_POST) $xtp->assign("msg", $msg);
        $xtp->assign("baseUrl", $baseUrl);
        $xtp->parse("EDIT");
        $content = $xtp->text("EDIT");
    }
    else {
		$content =  "You are not competent!";
	}
    
    
    