<?php
$city=$_GET['city'];
if (!preg_match("/^[a-zA-Z]{3,}$/", $city)){
echo "<font color=#FF0000>Your city is Invalid</font>";
}

?> 