<?php
	include("../libs/bootstrap.php");

	if($_SESSION['USERNAME'] != "") {
		$xtpl = new XTemplate("views/index.html");

		if(isset($_GET['m']) && isset($_GET['a'])) {
			$m = $_GET['m'];
			$a = $_GET['a'];

			if(file_exists("controllers/{$m}/{$a}.php")) {
				include("controllers/{$m}/{$a}.php");
				$xtpl->assign("content", $content);
			}
			else {
				echo "404 Error File's not found";
			}
		}
		else {
			header("location: {$baseUrl}/admin/?m=products&a=list");
		}

		$xtpl->assign("sessionUsn", $_SESSION['USERNAME']);
		$xtpl->assign("baseUrl", $baseUrl);
		$xtpl->parse("INDEX");
		$xtpl->out("INDEX");
	}
	else {
		header("location: {$baseUrl}/admin/login.php");
	}

	

	

