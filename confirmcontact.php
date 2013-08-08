<?php
session_start();
$name = $_POST['name'];
$company = $_POST['company'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$msg = $_POST['message'];
	if(empty($name) || empty ($email) || empty ($phone) || empty($msg)) {
		include "contact.php";
		print '<script type="text/javascript">';
		print 'alert("Please fill in required fields")';
		print '</script>'; 
		exit;
	}
	if(!preg_match("/^[a-zA-Z]{1,}$/",htmlentities($name))) {
	include "contact.php";
		print '<script type="text/javascript">';
		print 'alert("Your name is invalid")';
		print '</script>'; 
		exit;
	}

	if (!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/", htmlentities($email))) {
 
	include "userProfiles.php";
	print '<script type="text/javascript">';
	print 'alert("The email address '. $email.' is invalid")';
	print '</script>'; 
	exit;
	}
if(!empty($company)) {
	if(!preg_match("/^[[:alnum:] ]{1,25}$/i",htmlentities($company))) {
		include "register.php";
		print '<script type="text/javascript">';
		print 'alert("Your company is invalid")';
		print '</script>'; 
		exit;
	}
}	
	if(!preg_match("/^[0-9]{8,}$/",htmlentities($phone))) {
		include "register.php";
		print '<script type="text/javascript">';
		print 'alert("Your phone is invalid")';
		print '</script>'; 
		exit;
	}
	
	if (!preg_match("/^[[:alnum:][:punct:] ]{3,}$/i", htmlentities($msg))){
		include "register.php";
		print '<script type="text/javascript">';
		print 'alert("Please fill in your message")';
		print '</script>'; 
		exit;
	}
if(($_POST['captcha']) == $_SESSION['captcha']) {
		include "contact.php";
		print '<script type="text/javascript">';
		print 'alert("Thank you, We will reply you asap!!")';
		print '</script>'; 
		exit;
}else{
		include "contact.php";
		print '<script type="text/javascript">';
		print 'alert("Your captcha does not match, please try again")';
		print '</script>'; 
		exit;
}
?>