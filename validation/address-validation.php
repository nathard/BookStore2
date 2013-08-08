<?php
$addr=$_GET['addr'];
if (!preg_match("/^[0-9]{1,}+[a-zA-Z0-9]{0,}+[ ]{1}+[a-zA-Z0-9[ ]{1,}$/", $addr)){
echo "<font color=#FF0000>Your Address is Invalid</font>";
echo "<br />";
echo "<font color=#FF0000>eg: 16 Cloud st</font>";
}
?> 