<?php
  /* Set oracle user login and password info */
  $dbuser = "lshow";  /* your deakin login */
  $dbpass = "lshowdb";  /* your deakin password */
  $dbname = "SSID"; 
  $db = OCILogon($dbuser, $dbpass, $dbname); 

  if (!$db)  {
    echo "An error occurred connecting to the database"; 
    exit; 
  }
  
// Include functions
function listUsers() {
		global $db;
		$sql1 = 'drop table users;';
		$stmt1 = OCIParse($db, $sql1); 
  
			if(!$stmt1)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			OCIExecute($stmt1);

			
		$sql2 = 'create table users( FIRSTNAME varchar2(20), LASTNAME varchar2(20), USERNAME varchar2(15) default "" NOT NULL, PASSWORD varchar2(32) default "" NOT NULL, EMAIL varchar2(50) default "" NOT NULL, PHONE varchar2(15), COMPANY varchar2(25), ADDRESS varchar2(50), POSTCODE number(5), CITY varchar2(15), STATE varchar2(28), Primary key (USERNAME) );';
						
		$stmt2 = OCIParse($db, $sql2); 
  
			if(!$stmt2)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			OCIExecute($stmt2);
			
			
			$sql3 = 'INSERT INTO users VALUES ("axl", "p", "axl", "39c869cf2ba63b2c17e901df0f6ba1b4", "axl@mail.com", "123456789", "bookstore", "100 T street",1234,"Melb","Queensland");';
						
		$stmt2 = OCIParse($db, $sql3); 
  
			if(!$stmt3)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			OCIExecute($stmt3);
			
			
			$sql4 = 'commit;';
		$stmt4 = OCIParse($db, $sql4); 
  
			if(!$stmt4)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			OCIExecute($stmt4);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Book Store Admin</title>
<meta name="keywords" content="Book Store, Books" />
<meta name="description" content="Book Store Administration" />
<link href="style.css" rel="stylesheet" type="text/css" />

</head>
<body>
<?php
						echo listUsers();
					?>
</body>
</html>