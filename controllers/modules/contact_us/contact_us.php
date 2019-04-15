<?php
	$xtp = new XTemplate("{$baseUrl}/views/modules/contact_us.html");
	require 'phpmailer/PHPMailerAutoload.php';
	$mail = new PHPmailer;
	$mail ->isSMTP();
	if($_POST){
		$name = strtoupper($_POST['txtName']);
		$gender = $_POST['txtChoose'];
		$email = $_POST['txtEmail'];
		$phone = $_POST['txtPhone'];
		$message = $_POST['txtMessage'];
		$mail -> Mailer = 'smtp';
		$mail -> CharSet = 'utf-8';
		$mail -> Host = 'ssl://smtp.gmail.com';
		$mail -> Port = 465;
		$mail -> SMTPAuth = true;
		$mail -> SMTPSecure = 'ssl';
		$mail -> Username = 'jewcatslessthantree@gmail.com';
		$mail -> Password = 'jewcats123';
		$mail -> addAddress('jewcatslessthantree@gmail.com');
		$mail -> addReplyTo("{$email}");
	
		$mail -> isHTML(true);
		$mail -> Subject = "MESSAGE FROM: {$name}";
		$mail -> Body = "<h4>{$message}<h4><h3>Phone: {$phone}</h3><h3>Genger: {$gender}</h3>";
		if(!$mail -> send()){
			echo "<script type='text/javascript'>alert('Message could not be sent');</script>";
		}else echo "<script type='text/javascript'>alert('Message has been sent');</script>";
	}  
        
	$xtp->assign("baseUrl", $baseUrl);
	$xtp->parse("CONTACT_US");
	$contents = $xtp->text("CONTACT_US");