<?php
	$xtp = new XTemplate("{$baseUrl}/admin/views/categories/list.html");
	

	$sql = "SELECT * FROM tbl_categories WHERE 1 ORDER BY id DESC";
	$arr = $db->fetchAll($sql);

	foreach ($arr as $value) {
		$xtp->assign("LOOP", $value);

		$xtp->parse("LIST.LOOP");
	}
	
	$xtp->assign("baseUrl", $baseUrl);
	$xtp->parse("LIST");
	$content = $xtp->text("LIST");