<?php
$cc=$_GET['cc'];
if (!preg_match("/^[0-9]{16}$/", $cc)){
echo "<font color=#FF0000>Your cardNo is Invalid</font>";
}

?> 