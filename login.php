<?php
//database connection
require_once('inc/DBConnect.php');
//start session
session_start();
//get values from my account form
$username = $_POST['username'];
//User password
$user_password = $_POST['password'];
//htmlentities
$checkValidstring = htmlentities($_POST['username']);
if(!preg_match("/^[a-zA-Z0-9]{1,}$/", $checkValidstring))
{
	//unset($username);
	$_SESSION['username']="";
	include "re-login.php";
}
# Generate dynamic salt
$user_salt = sha1(microtime());

//Random String of salt used for everyone
$salt = 'tpqwtq77';

# Hash password
$passwords[] = $user_password;
$passwords[] = md5($user_password);
$passwords[] = md5($salt. $user_password);

//Show each one
foreach($passwords as $password) {
	$password;
}

$query="SELECT * FROM users WHERE USERNAME = '$username' AND PASSWORD='$password'";
$result = OCIParse($db,$query);

OCIExecute($result);
$rows= OCIFetchStatement($result,$RowsResult);

//check rows
if($rows !=1){
$error = "Your username/password is incorrect. Please try again";
unset($username);
$_SESSION['username']="";
include "re-login.php";
}else{
$_SESSION['username'] = "$username";
include 'loginSuccess.php';
}
?>