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
  
//used to retrive user info and display it
function DisplayUser() {
	global $db;
	$id = $_GET["username"];
	
	$sql = "SELECT * FROM users WHERE username = '$id'";
		
			$stmt = OCIParse($db, $sql); 
				
  
			if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			OCIExecute($stmt);

			while(OCIFetch($stmt)) {

				$firstName= OCIResult($stmt,"FIRSTNAME");
				$lastName= OCIResult($stmt,"LASTNAME");
				$email= OCIResult($stmt,"EMAIL");
				$phone= OCIResult($stmt,"PHONE");
				$company= OCIResult($stmt,"COMPANY");
				$address= OCIResult($stmt,"ADDRESS");
				$city= OCIResult($stmt,"CITY");
				$postCode= OCIResult($stmt,"POSTCODE");
				$state= OCIResult($stmt,"STATE");
				
				//format output
				$output[] = '<div class="form_row">';
				$output[] = '<label class="contact"><strong>User Name:</strong></label>';
				$output[] = '<input value= "'.$id.'" class="contact_input" type="text" name="userName" id="userName" readonly="readonly"/></div>';
				
				$output[] = '<div class="form_row">';
				$output[] = '<label class="contact"><strong>First name:</strong></label>';
				$output[] = '<input value= "'.$firstName.'" class="contact_input" type="text" name="firstName" id="firstName"/></div>';
										
				$output[] = '<div class="form_row">';
				$output[] = '<label class="contact"><strong>Last name:</strong></label>';
				$output[] = '<input value="'.$lastName.'" class="contact_input" type="text" name="lastName" id="lastName"/></div>';
		
				$output[] = '<div class="form_row">';
				$output[] = '<label class="contact"><strong>Email:</strong></label>';
				$output[] = '<input value="'.$email.'" class="contact_input" type="text" name="email" id="email"/></div>';			
				
				$output[] = '<div class="form_row">';
				$output[] = '<label class="contact"><strong>Phone:</strong></label>';
				$output[] = '<input value="'.$phone.'" class="contact_input" type="text" name="phone" id="phone"/></div>';
					
				$output[] = '<div class="form_row">';
				$output[] = '<label class="contact"><strong>Company:</strong></label>';
				$output[] = '<input value="'.$company.'" class="contact_input" type="text" name="company" id="company"/></div>';
					
				$output[] = '<div class="form_row">';
				$output[] = '<label class="contact"><strong>Address:</strong></label>';
				$output[] = '<input value="'.$address.'" class="contact_input" type="text" name="address" id="address"/></div>';
					
				$output[] = '<div class="form_row">';
				$output[] = '<label class="contact"><strong>City:</strong></label>';
				$output[] = '<input value="'.$city.'" class="contact_input" type="text" name="city" id="city"/></div>';
				
				$output[] = '<div class="form_row">';
				$output[] = '<label class="contact"><strong>Post Code:</strong></label>';
				$output[] = '<input value="'.$postCode.'" class="contact_input" type="text" name="postCode" id="postCode"/></div>';
				
				
				//display dropdown list of states and auto select the value stored for the user
				$output[] = '<div class="form_row">';
				$output[] = '<label class="contact"><strong>State:</strong></label>';
				$output[] = '<select value="" class="contact_input" name ="state" id="state">';
				$output[] = '<option value="South Australia"';
				
				if($state == "South Australia") {
				$output[] = 'selected="selected"'; }
				
				$output[] = '>South Australia</option>';
				$output[] = '<option value="Tasmania"';
				
				if($state == "Tasmania") {
				$output[] = 'selected="selected"'; }
				
				$output[] = '>Tasmania</option>';
				$output[] = '<option value="New South Wales"';
				
				if($state == "New South Wales") {
				$output[] = 'selected="selected"'; }
				
				$output[] = '>New South Wales</option>';
				$output[] = '<option value="Victoria"';
				
				if($state == "Victoria") {
				$output[] = 'selected="selected"'; }
				
				$output[] = '>Victoria</option>';
				$output[] = '<option value="Western Australia"';
				
				if($state == "Western Australia") {
				$output[] = 'selected="selected"'; }
				
				$output[] = '>Western Australia</option>';
				$output[] = '<option value="Northern Territory"';
				
				if($state == "Northern Territory") {
				$output[] = 'selected="selected"'; }
				
				$output[] = '>Northern Territory</option>';
				$output[] = '<option value="Queensland"';
				
				if($state == "Queensland") {
				$output[] = 'selected="selected"'; }
				
				$output[] = '>Queenslands</option></select></div>';
				
			}
			return join ('',$output);
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
        	
		<h1><a href="index.php">Administration</a> --> <a href="users.php">Users</a> --> Edit User</h1>
		<div class='contact_form'>
		<p>Enter new information into the form bellow then click update to change the users information</p>
                <div class='form_subtitle'>user information</div>
					<form name='updateInfo' action='updateUser.php' method='post'>
				
					<?php
						echo DisplayUser();
					?>
				
                <div class='form_row'>
					<input type='submit' class='login_input' value='Update' />             
                </div>
			</form>
        </div>
            
			
        </div> <!-- end of content right -->
    
    	<div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->
    
    <?php include("inc/footer.php") ?>   
    <!-- end of footer -->

</div> <!-- end of container -->
</body>
</html>