<?php
  /* Set oracle user login and password info */
  $dbuser = "vtl";  /* your database login */
  $dbpass = "07071987";  /* your database password */
  $dbname = "SSID"; 
  $db = OCILogon($dbuser, $dbpass, $dbname); 

  if (!$db)  { 
	echo "An error occurred connecting to the database"; 
    exit; 
  }
  
  // Update user function
  function Update() {
			global $db;
			//store variables
			$userName= $_POST['userName'];
			$firstName= $_POST['firstName'];
			$lastName= $_POST['lastName'];
			$email= $_POST['email'];
			$phone= $_POST['phone'];
			$company= $_POST['company'];
			$address= $_POST['address'];
			$city= $_POST['city'];
			$postCode= $_POST['postCode'];
			$state= $_POST['state'];
			
			
			//condition if all values are valid
			$valid= true;
			
			
			//check all entered values
			if(!preg_match("/^[0-9]{1,}+[a-zA-Z0-9]{0,}+[ ]{1}+[a-zA-Z0-9[ ]{1,}$/",htmlentities($_POST['address']))) {
				echo("Your address is invalid<br />"); 
				$valid = false;
			}
			if(!preg_match("/^[0-9]{8,}$/",htmlentities($_POST['phone']))) {
				echo("Your phone is invalid<br />"); 
				$valid = false;
			}
			if(!preg_match("/^[[:alnum:] ]{6,25}$/i",htmlentities($_POST['company']))) {
				echo("Your company is invalid<br />"); 
				$valid = false;
			}
			if(!preg_match("/^[0-9]{4,}$/",htmlentities($_POST['postCode']))) {
				echo("Your post code is invalid<br />"); 
				$valid = false;
			}

			if(!preg_match("/^[a-zA-Z]{1,}$/",htmlentities($_POST['firstName']))) {
				echo("Your first name is invalid<br />"); 
				$valid = false;
			}
			if(!preg_match("/^[a-zA-Z]{1,}$/i",htmlentities($_POST['lastName']))) {
				echo("Your last name is invalid<br />"); 
				$valid = false;
			}
			if(!preg_match("/^[a-zA-Z]{3,}$/",htmlentities($_POST['city']))) {
				echo("Your city is invalid<br />"); 
				$valid = false;
			}
			if(!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/",htmlentities($_POST['email']))) {
				echo("Your email is invalid<br />"); 
				$valid = false;
			}
			
			//if all values valid update user info
			if($valid)
			{
				$sql = "UPDATE users SET FIRSTNAME = '$firstName', LASTNAME = '$lastName', EMAIL = '$email', PHONE = '$phone', COMPANY = '$company', ADDRESS = '$address', CITY = '$city', POSTCODE = '$postCode', STATE = '$state' WHERE username = '$userName'";
						
				$stmt = OCIParse($db, $sql); 
  
			if(!$stmt)  { 
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			OCIExecute($stmt);
			
			echo ("Update Successful<br />");
			echo('<a href="user.php">Click here to return</a>');
			}
			else{
				echo ('<a href="#" onclick="history.back();">Click Here to go back</a>');
			}
		}

?>

<?php include("inc/header.php") ?> 
	<!-- end of header -->
    
    <div id="templatemo_content">
    	
        <div id="templatemo_content_left">
        	<div class="templatemo_content_left_section">
            	<h1>Tools</h1>
                <ul>
                    <li><a href="books.php">Books Admin</a></li>
                    <li><a href="orders.php">Orders Admin</a></li>
                    <li><a href="users.php">Users Admin</a></li>
            	</ul>
            </div>
			
            
            <div class="templatemo_content_left_section">                
                <a href="http://validator.w3.org/check?uri=referer"><img style="border:0;width:88px;height:31px" src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Transitional" width="88" height="31" vspace="8" border="0" /></a>
<a href="http://jigsaw.w3.org/css-validator/check/referer"><img style="border:0;width:88px;height:31px"  src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!" vspace="8" border="0" /></a>
			</div>
        </div> <!-- end of content left -->
        
        <div id="templatemo_content_right">
        	<h2>
			<?php
						echo Update();
					?>
			</h2>
        </div> <!-- end of content right -->
    
    	<div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->
    
    <?php include("inc/footer.php") ?>   
    <!-- end of footer -->

</div> <!-- end of container -->
</body>
</html>