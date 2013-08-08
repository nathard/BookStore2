<?php
$year=$_GET['year'];
if (!preg_match("/^[0-9][0-9]$/", $year)){
echo "<font color=#FF0000>Need 2 digits in this field</font>";
}
?> 