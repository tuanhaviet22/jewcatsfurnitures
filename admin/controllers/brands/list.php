<?php
	$xtp = new XTemplate("{$baseUrl}/admin/views/brands/list.html");
	

	$sql = "SELECT * FROM tbl_brands WHERE 1 ORDER BY id DESC";
	$arr = $db->fetchAll($sql);

	foreach ($arr as $value) {
		$xtp->assign("LOOP", $value);
		$xtp->assign("baseUrl", $baseUrl);

		$xtp->parse("LIST.LOOP");
	}
	
	$xtp->assign("baseUrl", $baseUrl);

	$xtp->parse("LIST");
	$content = $xtp->text("LIST");