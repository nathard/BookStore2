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

//Used to search and display users
function searchUser() {
	global $db;
	$id = $_GET["username"];
	
	if(!$id) {
	//if not user display all
	$sql = "SELECT * FROM users"; }
	else {
	//else display users information
	$sql = "SELECT * FROM users WHERE username like '%". $id ."%'"; }
		
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
				$userName= OCIResult($stmt,"USERNAME");
				
				
				//format output
				$output[] = '<tr><td>'.$userName.'</td>';
				$output[] = '<td>'.$firstName.'</td>';
				$output[] = '<td>'.$lastName.'</td>';
				$output[] = '<td>'.$email.'</td>';
				$output[] = '<td><a href="editUser.php?username='.$userName.'">Edit</a>'; 
				$output[] = '<a href="#" onClick="jsDelete(\''.$userName.'\')" > Delete</a></td></tr>';
			}
			if(!$output)  {
				echo "There is no user match your search condition.\n";  
			  }
			else return join ('',$output);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" language="Javascript">
	function jsDelete(id){
		var ans = confirm("Are you sure?");
		if(ans == true){
			window.location.href='deleteUser.php?userName=' + id;
		}
	}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Book Store Admin</title>
<meta name="keywords" content="Book Store, Books" />
<meta name="description" content="Book Store Administration" />
<link href="style.css" rel="stylesheet" type="text/css" />

</head>
<body>
<!--  Content -->
<div id="templatemo_container">
	<!-- header -->
	<div id="templatemo_menu">
    	<ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="books.php">Books</a></li>
            <li><a href="orders.php">Orders</a></li>            
            <li><a href="users.php">Users</a></li>
    	</ul>
    </div> <!-- end of menu -->
    
    <div id="templatemo_header">
    </div> 
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
        	
		<h1><a href="index.php">Administration</a> --> Users</h1>
		
			<div class="feat_prod_box_details">
                <form name='searchUser' action='users.php' method='get'>
				<div class='form_row'>
					<h2>Search User</h2>
					<input type='text' name='username' id='username' class='contact_input'/>
					<input type='submit' value='search' action = searchUsers() />  
                </div>                        
                <p>Enter a username into the textbox above to find that user.</p>
				<p> If the textbox is left empty all users will be show.</p>
			</div>		
               

				
				
				<table border='1' width = '100%'>
					<tr class='cart_title'>
						<td width = '20%'>User name</td>
						<td width = '20%'>First name</td>
						<td width = '20%'>Last name</td>
						<td width = '20%'>Email</td>
						<td>Action</td>
						
					</tr>
					
					<?php
						echo searchUser();
					?>
				</table>
                </form>
            
			
        </div> <!-- end of content right -->
    
    	<div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->
    
    <?php include("inc/footer.php") ?>  
    <!-- end of footer -->

</div> <!-- end of container -->
</body>
</html>