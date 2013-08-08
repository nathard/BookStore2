<?php
      $dfname = $_GET["dfname"];
if (!preg_match("/^[a-zA-Z]{1,}$/", $dfname)){
echo "<font color=#FF0000> Please enter your first name</font>";
}
?>
