<?php
    $xtp = new XTemplate("{$baseUrl}/views/modules/cart.html");

    if(isset($_SESSION['CUSTOMERNAME'])) {
        $usn = $_SESSION['CUSTOMERNAME'];

        $sql = "SELECT * FROM tbl_customers WHERE cus_usn = '{$usn}'";
        $arr = $db->fetchOne($sql);

        $xtp->assign($arr, "CART");
    }


    $xtp->assign("baseUrl", $baseUrl);
	$xtp->parse("CART");
	$contents = $xtp->text("CART");