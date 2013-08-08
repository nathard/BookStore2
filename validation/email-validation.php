<?php
$email=$_GET['email'];
if (!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/", $email)){
//echo $email;
echo "<font color=#FF0000> Invalid. eg: lion@forestmail.com</font>";
}else{
echo "$email<font color=#04B404> is Valid</font>";}

?> 