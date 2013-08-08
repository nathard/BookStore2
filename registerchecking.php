<?php
//database connection
require_once('inc/DBConnect.php');

$email = $_POST['email'];    
$username = $_POST['username'];
//User password
$user_password = $_POST['password'];
$user_password2 = $_POST['repassword'];
//htmlentities
if(!preg_match("/^[a-zA-Z0-9]{1,}$/",htmlentities($_POST['username']))) {
		include "register.php";
		print '<script type="text/javascript">';
		print 'alert("Your username is invalid")';
		print '</script>'; 
		exit;
}

if(!preg_match("/^[[:alnum:][:punct:] ]{6,25}$/i",$_POST['password'])) {
		include "register.php";
		print '<script type="text/javascript">';
		print 'alert("Your password is invalid")';
		print '</script>'; 
		exit;
}
if(!empty($address)) {
	if(!preg_match("/^[0-9]{1,}+[a-zA-Z0-9]{0,}+[ ]{1}+[a-zA-Z0-9[ ]{1,}$/",htmlentities($_POST['address']))) {
		include "register.php";
		print '<script type="text/javascript">';
		print 'alert("Your address is invalid")';
		print '</script>'; 
		exit;
	}
}
if(!empty($phone)) {
	if(!preg_match("/^[0-9]{8,}$/",htmlentities($_POST['phone']))) {
		include "register.php";
		print '<script type="text/javascript">';
		print 'alert("Your phone is invalid")';
		print '</script>'; 
		exit;
	}
}
if(!empty($company)) {
	if(!preg_match("/^[[:alnum:] ]{1,25}$/i",htmlentities($_POST['company']))) {
		include "register.php";
		print '<script type="text/javascript">';
		print 'alert("Your company is invalid")';
		print '</script>'; 
		exit;
	}
}

# Generate dynamic salt

//Random String of salt used for everyone
$salt = 'tpqwtq77';

# Hash password
$passwords[] = $user_password;
$passwords[] = md5($user_password);
$passwords[] = md5($salt. $user_password);

$repasswords[] = $user_password2;
$repasswords[] = md5($user_password2);
$repasswords[] = md5($salt. $user_password2);

//Show each one
foreach($passwords as $password) {
	$password;
}
foreach($repasswords as $repassword) {
	$repassword;
}


$address = $_POST['address'];
$phone = $_POST['phone'];
$company = $_POST['company'];
$state = $_POST['state'];
$acceptTerm = $_POST['terms'];
// check username already exists
$checkuserQuery = "SELECT * FROM users WHERE USERNAME='$username'";
$checkuser = OCIParse($db,$checkuserQuery);
if(!$checkuser)  {
    echo "An error occurred in parsing the sql string.\n"; 
    exit; 
  }
OCIExecute($checkuser);
$rows= OCIFetchStatement($checkuser,$result);
$username_exist = $rows;
//check info
if($username_exist > 0){
    unset($username);
    include 're-register.php';
    exit;
}
if (empty($username) && empty($password) && empty($repassword) && empty($email))
{
		include "register.php";
		print '<script type="text/javascript">';
		print 'alert("Please fill in all required fields")';
		print '</script>'; 
		exit;
}
	if(strlen($password) < 6 && strlen($repassword) < 6) {
		include "register.php";
		print '<script type="text/javascript">';
		print 'alert("Need at least 6 characters for a password")';
		print '</script>'; 
		exit;
	}
	if($password != $repassword) {
		include "register.php";
		print '<script type="text/javascript">';
		print 'alert("Your password not match")';
		print '</script>'; 
		exit;	
	}
	
	if (!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/", htmlentities($email))){ 
		include "register.php";
		print '<script type="text/javascript">';
		print 'alert("The email address '. $email.' is invalid")';
		print '</script>'; 
		exit;
	}
	
	if($acceptTerm != 'accept') {
		include "register.php";
		print '<script type="text/javascript">';
		print 'alert("Please accept our terms and conditions if you wish an new account")';
		print '</script>'; 
		exit;
	}
	$query = "INSERT INTO users(USERNAME, PASSWORD, EMAIL, PHONE, COMPANY, ADDRESS, STATE) VALUES('$username', '$password', '$email', '$phone', '$company', '$address', '$state')";
	$stmt = OCIParse($db, $query);
  
	if(!$stmt)  {
		echo "An error occurred in parsing the sql string.\n"; 
		exit; 
	}
	OCIExecute($stmt); 
	

// mail user their information

$mysite = 'www.bookstore.com';
$admin = 'Book Store Admin';
$myemail = 'nlha@deakin.edu.au';
    $emailPassword = $_POST['password'];
$subject = "You have successfully registered at $mysite...";
$message = "Dear $username, you have just registered at our web site.  
    To login, simply go to our web page and enter in the following details in the login form:
    Username: $username
    Password: $emailPassword    
    
    Thanks you,
    $admin";
    
mail($email, $subject, $message, "From: $mysite <$myemail>\nX-Mailer:PHP/" . phpversion());
    
include 'registerSuccess.php';
?>