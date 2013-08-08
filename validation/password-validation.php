<?php
$passwd=$_GET['password'];
//if (!preg_match("/^[\w\d]{6,25}$/i", $passwd)){
//if(!preg_match("/^.*(?=.{4,10})(?=.*\d)(?=.*[a-zA-Z]).*$/",$passwd)) at least one digit in any position, at least one upper or lower case in any position, consist of 4-10 characters 
if (!preg_match("/^[[:alnum:][:punct:] ]{6,25}$/i", $passwd)){
echo "<font color=#FF0000> Need at least 6 characters</font>";
}
?> 