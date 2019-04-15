<?php
    $sql = "SELECT id, pro_status FROM tbl_products WHERE 1 ORDER BY id DESC";
    $arr = $db->fetchAll($sql);

    echo json_encode($arr); 
    
    exit(0);