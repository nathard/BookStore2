<?php
$pcode=$_GET['pcode'];
if (!preg_match("/^[0-9]{4,}$/", $pcode)){
echo "<font color=#FF0000>Your postal code is Invalid</font>";
}

?> 