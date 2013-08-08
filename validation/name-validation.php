<?php
      $name = $_GET["name"];
if (!preg_match("/^[a-zA-Z]{1,}$/", $name)){
echo "<font color=#FF0000> Please enter your name</font>";
}
?>
