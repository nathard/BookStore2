<?php
$dpcode=$_GET['dpcode'];
if (!preg_match("/^[0-9]{4,}$/", $dpcode)){
echo "<font color=#FF0000>Your postal code is Invalid</font>";
}

?> 