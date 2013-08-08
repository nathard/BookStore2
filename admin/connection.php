<?php
	/* Set oracle user login and password info */
	$dbuser = "vtl"; /* your deakin login */
	$dbpass = "07071987"; /* your oracle access password */
	$db = "SSID";
	$connect = OCILogon($dbuser, $dbpass, $db);
	if (!$connect) {
		echo "An error occurred connecting to the database";					
		exit;
	}
?>