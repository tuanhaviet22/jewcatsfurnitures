<?php
	include("../libs/bootstrap.php");

	$_SESSION['USERNAME'] = "";
	$_SESSION['ROLE'] = "";

	header("location: {$baseUrl}/admin");