<?php
$csc=$_GET['csc'];
if (!preg_match("/^[0-9]{3}$/", $csc)){
echo "<font color=#FF0000>Your CSC is Invalid</font>";
}

?> 