<?php
$phone=$_GET['phone'];
if (!preg_match("/^[0-9]{8,}$/", $phone)){
echo "<font color=#FF0000> Need at least 8 digits</font>";
}
?> 