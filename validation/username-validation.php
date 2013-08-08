<?php
      $username = $_GET["username"];
if (!preg_match("/^[a-z]+[a-z0-9_]{2,}+[_a-z0-9]{0,}$/", $username)){
echo "<font color=#FF0000>Invalid. Need at least 3 characters";
echo "<br />You only can start by a letter and cannot user capital characters in username";
echo "<br />eg: apple, an_apple, apple123 ";
echo "</font>";
}
?>
