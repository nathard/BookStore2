<?php
      $fname = $_GET["fname"];
if (!preg_match("/^[a-zA-Z]{1,}$/", $fname)){
echo "<font color=#FF0000> Please enter your first name</font>";
}
?>
