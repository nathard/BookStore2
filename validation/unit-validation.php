<?php
$unit=$_GET['unit'];
if (!preg_match("/^[0-9]{1,}+[a-zA-Z0-9]{0,}$/", $unit)){
echo "<font color=#FF0000>Your unit is Invalid</font>";
}

?> 