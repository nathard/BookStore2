<?php

  /* Set oracle user login and password info */

$dbuser ="vtl";
$dbpass ="07071987";
$dbname= "SSID";

$db=OCILogon($dbuser, $dbpass, $dbname);

if (!$db){
    echo "An error occurred connecting to the database"; 
    exit; 
  }
?>