<?php
    if($_SESSION['ROLE'] <= 2) {
        $xtp = new XTemplate("{$baseUrl}/admin/views/staffs/list.html");
        

        $sql = "SELECT * FROM tbl_staffs WHERE 1 ORDER BY id DESC";
        $arr = $db->fetchAll($sql);

        foreach ($arr as $value) {
            $xtp->assign("LOOP", $value);

            switch($value['stf_status']) {
                case 0: $status = "Inactive"; break;
                case 1: $status = "Active"; break;
                case 2: $status = "Absent"; break;
            }
            $xtp->assign("status", $status);

            $xtp->parse("LIST.LOOP");
        }
        
        $xtp->assign("baseUrl", $baseUrl);

        $xtp->parse("LIST");
        $content = $xtp->text("LIST");
    }
    else {
		$content =  "You are not competent!";
	}