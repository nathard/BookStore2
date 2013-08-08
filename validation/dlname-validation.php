<?php
   $dlname = $_GET["dlname"];   
if (!preg_match("/^[a-zA-Z]{1,}$/", $dlname)){
echo "<font color=#FF0000> Please enter your last name</font>";
}
?>
