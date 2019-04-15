<?php
    $sql = "SELECT id, stf_status FROM tbl_staffs WHERE 1";
    $arr = $db->fetchAll($sql);

    if(count($arr) > 0) echo json_encode($arr);
	else echo json_encode("");
    exit(0);