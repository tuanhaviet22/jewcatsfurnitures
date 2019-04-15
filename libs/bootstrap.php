<?php
	session_start();
	include("database.class.php");
	include("xtemplate.class.php");
	include("file.class.php");
	include("validation.class.php");

	$baseUrl = "http://".$_SERVER['HTTP_HOST']."/jewcatsfurnitures";
	$salt = md5("md5");

	$dsn = "mysql:host=localhost;port=3306;dbname=jewcatsfurnituresdb";
	$usn = "root";
	$pwd = "";
	
	$db = new database($dsn, $usn, $pwd);
	$f = new file;
	$valid = new validation;