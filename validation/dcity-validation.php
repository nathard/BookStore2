<?php
$dcity=$_GET['dcity'];
if (!preg_match("/^[a-zA-Z]{3,}$/", $dcity)){
echo "<font color=#FF0000>Your city is Invalid</font>";
}

?> 