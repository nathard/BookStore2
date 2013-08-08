<?php
session_start();

if ( !empty( $username ) ) {

    //print "Please login below!";
	$username = "";
    include 'myaccount.php';
}
?>