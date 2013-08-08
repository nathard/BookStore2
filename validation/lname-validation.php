<?php
   $lname = $_GET["lname"];   
if (!preg_match("/^[a-zA-Z]{1,}$/i", $lname)){
echo "<font color=#FF0000> Please enter your last name</font>";
}
?>
