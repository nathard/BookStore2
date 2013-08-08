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
  
  //Used to delete a user from the database
  function Delete() {
			global $db;
			$userName= $_GET['userName'];
			$valid = true;
			
			if($valid)
			{
			//Check to see if user has any outstanding book orders
				$sql1 = "SELECT * FROM orders WHERE username = '$userName'";
				$stmt1 = OCIParse($db, $sql1); 
				
  
				if(!$stmt1)  {
					echo "An error occurred in parsing the sql string.\n"; 
					exit; 
				  }
				OCIExecute($stmt1);
				
				$testUser = " ";
				while(OCIFetch($stmt1)) {

					$testUser= OCIResult($stmt1,"USERNAME");
				}
				
				if ($testUser == $userName) {
					echo ("an order exist for this user<br />");
					echo('<a href="users.php?">Click here to return</a>');
					$valid = false;
				}
			}
			
			//If no orders found delete user
			if ($valid) {
				$sql = "DELETE FROM users WHERE username = '$userName'";
							
				$stmt = OCIParse($db, $sql); 
	  
				if(!$stmt)  { 
					echo "An error occurred in parsing the sql string.\n"; 
					exit; 
				  }
				OCIExecute($stmt);
				
				echo ("Delete Successful ");
				echo('<a href="users.php?">Click here to return</a>');
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
						echo Delete();
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