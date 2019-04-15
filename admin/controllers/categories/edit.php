<?php
    if($_SESSION['ROLE'] <= 3) {
        $xtp = new XTemplate("{$baseUrl}/admin/views/categories/edit.html");
        $id = $_GET['id'];

        // get old data
        $sql = "SELECT * FROM tbl_categories WHERE id = '{$id}'";
        $arr = $db->fetchOne($sql);
        $xtp->assign("oldName", $arr['cat_name']);

        
        if($_POST) {
            // validate
            $name = $_POST['txtName'];

            $flag = 1;
            $sql = "SELECT * FROM tbl_categories WHERE cat_name = '{$name}' AND id != '{$id}'";
            $arr = $db->fetchOne($sql);
            if(strlen($arr['cat_name']) > 0) $flag = 0;
        
            // update data to database
            if($flag != 0) {
                $arr = array("cat_name" => $name);
                $db->updateTbl("tbl_categories", $arr, "id = '{$id}'");
                
                $msg = "Successful!";
            }
            else {
                $msg = "Failed! (category exists)";
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
    
    
    