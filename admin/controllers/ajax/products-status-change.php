<?php
    if($_POST) {
        $id = $_POST['idchange'];

        $sql = "SELECT pro_status FROM tbl_products WHERE id = {$id} ORDER BY id DESC";
        $old_status = $db->fetchOne($sql)['pro_status'];

        $new_status = ($old_status == 1)?0:1;

        $arr = array("pro_status" => $new_status);
        $db->updateTbl("tbl_products", $arr, "id = {$id}");

        echo json_encode($new_status);
    }
    exit(0);