<?php
    if($_POST) {
        $id = $_POST['id'];
        $stt = $_POST['stt'];

        $arr = array("ord_status" => $stt);
        $db->updateTbl("tbl_orders", $arr, "id={$id}");

        echo json_encode($arr);
    }
    exit(0);