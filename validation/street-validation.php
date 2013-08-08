<?php
$st=$_GET['st'];
if (!preg_match("/^[a-zA-Z0-9 ]{3,}$/", $st)){
echo "<font color=#FF0000>Your street is Invalid</font>";
}

?> 