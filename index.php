<?php
	include("libs/bootstrap.php");

	// Modules
	if(isset($_GET['m']) && isset($_GET['a'])) {
		$xtpl = new XTemplate("{$baseUrl}/views/index.html");

		$m = $_GET['m'];
		$a = $_GET['a'];

		if(file_exists("controllers/modules/{$m}/{$a}.php")) {
			include("controllers/modules/{$m}/{$a}.php");

			$xtpl->assign("contents",$contents);
			$xtpl->assign("baseUrl", $baseUrl);
			$xtpl->parse("INDEX");
			$xtpl->out("INDEX");
		}
	}
	// Homepage
	else {
		$xtpl = new XTemplate("{$baseUrl}/views/homepage.html");
		include("controllers/homepage/autoload.php");
		
		$xtpl->assign("contents",$contents);
		$xtpl->assign("baseUrl", $baseUrl);
		$xtpl->parse("INDEX");
		$xtpl->out("INDEX");
	}

	

	
	
	

	

