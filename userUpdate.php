<?php
//database connection
require_once('inc/DBConnect.php');
session_start();
$Lname = $_POST['Lname'];
$Fname = $_POST['Fname'];
$email = $_POST['email'];    
$username = $_SESSION['username'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$company = $_POST['company'];
$postcode = $_POST['postalCode'];
$city = $_POST['city'];
$state = $_POST['state'];

	// in customer details form
	if(empty($Fname) || empty($Lname) || empty($email) || empty($state) || empty($postcode) || empty($city) || empty($address) || empty($phone)) {
			include "userProfiles.php";
				print '<script type="text/javascript">';
				print 'alert("Please fill in all required fields")';
				print '</script>'; 
				exit;
	}

if (!preg_match("/^[a-zA-Z]{1,}$/", $Fname)){
	include "userProfiles.php";
	print '<script type="text/javascript">';
	print 'alert("Your firstname is Invalid")';
	print '</script>'; 
	exit;
}
if (!preg_match("/^[a-zA-Z]{1,}$/i", $Lname)){
	include "userProfiles.php";
	print '<script type="text/javascript">';
	print 'alert("Your lastname is Invalid")';
	print '</script>'; 
	exit;
}

if (!preg_match("/^[0-9]{8,}$/", $phone)){
	include "userProfiles.php";
	print '<script type="text/javascript">';
	print 'alert("Your phone is Invalid, need at least 8 digits")';
	print '</script>'; 
	exit;
}
if(!preg_match("/^[0-9]{1,}+[a-zA-Z0-9]{0,}+[ ]{1}+[a-zA-Z0-9[ ]{1,}$/",htmlentities($_POST['address']))) {
		include "userProfiles.php";
		print '<script type="text/javascript">';
		print 'alert("Your address is invalid")';
		print '</script>'; 
		exit;
	}
if (!preg_match("/^[a-zA-Z]{3,}$/", $city)){	
	include "userProfiles.php";
	print '<script type="text/javascript">';
	print 'alert("Your postal city is Invalid")';
	print '</script>'; 
	exit;
}
if (!preg_match("/^[0-9]{4,}$/", $postcode)){
	include "userProfiles.php";
	print '<script type="text/javascript">';
	print 'alert("Your postal code is Invalid")';
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
$Query = "UPDATE users SET FIRSTNAME = '$Fname', LASTNAME = '$Lname', EMAIL = '$email', PHONE = '$phone', COMPANY = '$company', ADDRESS = '$address', POSTCODE = '$postcode', CITY = '$city', STATE = '$state' WHERE USERNAME='$username'";
$stmt = OCIParse($db,$Query);
if(!$stmt)  {
    echo "An error occurred in parsing the sql string.\n"; 
    exit; 
  }
OCIExecute($stmt);
include "UpdateSuccess.php";
?>