<?php
//database connection
require_once('inc/DBConnect.php');
//functions for shopping cart
require_once('inc/functions4cart.php');
//functions for details
require_once('inc/functions4details.php');
//start session
session_start();
// Process actions
$detail = $_SESSION['detail'];
$category = $_SESSION['category'];
$action = $_GET['action'];

if($action == 'show') {
$detail = $_GET['id'];
$category = $_GET['id'];
	
}
$_SESSION['detail'] = $detail;
$_SESSION['category'] = $category;

$username = $_SESSION['username'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Book Store</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/loadXMLnXSL.js"></script>
<script type="text/javascript" src="js/form-validation.js"></script>
<script type="text/javascript" src="js/type-validation.js"></script>
<script type="text/javascript" src="js/livesearch.js"></script>
</head>
<body>
<!--menu header-->

<?php include("inc/header.php") ?>

<!-- end of header -->
	<form method="get" action="instantSearch.php">
	<div class="search_bar">
		 <input type="text" id= "search" name ="instantSearch" size="72" onkeyup="displayResult(this.value);" value=""/>			
			<input type="submit" value="Search" class="login_input"/>			
				
			<div id="livesearch" class="livesearch"></div>	
			</div>
		</form>
		<div class="search_bar">
		<div class="bottom_search_bar">
            <a href="Search.php" class="advancedSearch">Advanced Search</a>
            </div>
       </div>
    <?php 
					echo showTotal4RightContent();
			
					?>
    <div id="templatemo_content">
    	<!--left content-->
        
    	<?php include("inc/leftcontent.php") ?>
    	
    	<!-- end of content left -->
        <!--right content-->
        <div id="templatemo_content_right">
        	<div class="crumb_nav">
            <a href="index.php">Home</a> &gt;&gt; My Account
            </div>
			
            <h1>Profiles</h1>
			        
        	<div class="feat_prod_box_details">
            <p class="details">
             You can update your information here			 
            </p>
            
              	<div class="contact_form">
                <div class="form_subtitle">Customer Details</div>	
                <div class="requiredField">* is required field</div>		
                <form name="Customer_Details" id="Customer_Details" action="userUpdate.php" method="post">
<?php
//get user info
$sql = "SELECT * FROM users WHERE USERNAME LIKE '$username'";

$stmt = OCIParse($db, $sql); 
  
if(!$stmt)  {
    echo "An error occurred in parsing the sql string.\n"; 
    exit; 
  }
OCIExecute($stmt); 


while(OCIFetch($stmt)) {

	$Fname= OCIResult($stmt,"FIRSTNAME");
	$Lname = OCIResult($stmt,"LASTNAME");	
	$email = OCIResult($stmt,"EMAIL");	
	$phone = OCIResult($stmt,"PHONE");	
	$company = OCIResult($stmt,"COMPANY");
	$address = OCIResult($stmt,"ADDRESS");
	$postcode = OCIResult($stmt,"POSTCODE");
	$city = OCIResult($stmt,"CITY");
	$state = OCIResult($stmt,"STATE");
			
	
	$output[]= "<div class='form_row'>";
    $output[]= "<label class='contact'><strong>First Name:<span class='asterisk'>*</span></strong></label>";
    $output[]= "<input type='text' class='contact_input' name ='Fname' id='Fname' maxlength='20' onblur='FNameValidator(this.value);' value='$Fname'/>";
	$output[]= "<label id='FNameError' class='errorMsg'></label>";
    $output[]= "</div>";


	$output[]= "<div class='form_row'>";
	$output[]= "<label class='contact'><strong>Last Name:<span class='asterisk'>*</span></strong></label>";
    $output[]= "<input type='text' class='contact_input' name='Lname' maxlength='20' onblur='LNameValidator(this.value);' value='$Lname'/>";
	$output[]= "<label id='LNameError' class='errorMsg'></label>";
    $output[]= "</div>";

    $output[]= "<div class='form_row'>";
    $output[]= "<label class='contact'><strong>Email:<span class='asterisk'>*</span></strong></label>";
    $output[]= "<input type='text' class='contact_input' name='email' maxlength='50' onblur='EmailValidator(this.value);' value='$email'/>";
	$output[]= "<label id='MailError' class='errorMsg'></label>";
    $output[]= "</div>";

	
    $output[]= "<div class='form_row'>";
    $output[]= "<label class='contact'><strong>Phone:<span class='asterisk'>*</span></strong></label>";
    $output[]= "<input type='text' class='contact_input' name='phone' maxlength='12' onblur='PhoneValidator(this.value);' onkeypress='return numbersonly(event,false);' value='$phone'/>";
	$output[]= "<label id='PhoneError' class='errorMsg'></label>";
    $output[]= "</div>";    

    $output[]= "<div class='form_row'>";
    $output[]= "<label class='contact'><strong>Company:</strong></label>";
    $output[]= "<input type='text' class='contact_input' name='company' maxlength='25' value='$company'/>";
    $output[]= "</div>";
                    
    $output[]= "<div class='form_row'>";
    $output[]= "<label class='contact'><strong>Address:<span class='asterisk'>*</span></strong></label>";
    $output[]= "<input type='text' class='contact_input' name='address' maxlength='50' onblur='AddressValidator(this.value);' value='$address'/>";
	$output[]= "<label id='AddressError' class='errorMsg'></label>";
    $output[]= "</div>";                    
					
	$output[]= "<div class='form_row'>";
    $output[]= "<label class='contact'><strong>City:<span class='asterisk'>*</span></strong></label>";
    $output[]= "<input type='text' class='contact_input' name='city' maxlength='15' onblur='CityValidator(this.value);' value='$city'/>";
	$output[]= "<label id='CityError' class='errorMsg'></label>";
    $output[]= "</div>";
					
					
	$output[]= "<div class='form_row'>";
    $output[]= "<label class='contact'><strong>Post Code:<span class='asterisk'>*</span></strong></label>";
    $output[]= "<input type='text' class='contact_input' maxlength='5' name='postalCode' onblur='PostcodeValidator(this.value);' onkeypress='return numbersonly(event,false);' value='$postcode'/>";
	$output[]= "<label id='PcodeError' class='errorMsg'></label>";
    $output[]= "</div>";				

    $output[]= "<div class='form_row'>";
    $output[]= "<label class='contact'><strong>State:<span class='asterisk'>*</span></strong></label>";
    $output[]= "<select name='state'>";
	
		if ($state == "Australian Capital Territory") {
			$output[]= "<option selected= 'selected'>Australian Capital Territory</option>";
			$output[]= "<option>New South Wales</option>";
			$output[]= "<option>Northern Territory</option>";
			$output[]= "<option>Queensland</option>";
			$output[]= "<option>South Australia</option>";
			$output[]= "<option>Tasmania</option>";
			$output[]= "<option>Victoria</option>";
			$output[]= "<option>Western Australia</option>";
		}
		if ($state == "New South Wales") {
			$output[]= "<option>Australian Capital Territory</option>";
			$output[]= "<option selected= 'selected'>New South Wales</option>";
			$output[]= "<option>Northern Territory</option>";
			$output[]= "<option>Queensland</option>";
			$output[]= "<option>South Australia</option>";
			$output[]= "<option>Tasmania</option>";
			$output[]= "<option>Victoria</option>";
			$output[]= "<option>Western Australia</option>";
		}
		if ($state == "Northern Territory") {
			$output[]= "<option>Australian Capital Territory</option>";
			$output[]= "<option>New South Wales</option>";
			$output[]= "<option selected= 'selected'>Northern Territory</option>";
			$output[]= "<option>Queensland</option>";
			$output[]= "<option>South Australia</option>";
			$output[]= "<option>Tasmania</option>";
			$output[]= "<option>Victoria</option>";
			$output[]= "<option>Western Australia</option>";
		}
			if ($state == "Queensland") {
			$output[]= "<option>Australian Capital Territory</option>";
			$output[]= "<option>New South Wales</option>";
			$output[]= "<option>Northern Territory</option>";
			$output[]= "<option selected= 'selected'>Queensland</option>";
			$output[]= "<option>South Australia</option>";
			$output[]= "<option>Tasmania</option>";
			$output[]= "<option>Victoria</option>";
			$output[]= "<option>Western Australia</option>";
		}
			if ($state == "South Australia") {
			$output[]= "<option>Australian Capital Territory</option>";
			$output[]= "<option>New South Wales</option>";
			$output[]= "<option>Northern Territory</option>";
			$output[]= "<option>Queensland</option>";
			$output[]= "<option selected='selected'>South Australia</option>";
			$output[]= "<option>Tasmania</option>";
			$output[]= "<option>Victoria</option>";
			$output[]= "<option>Western Australia</option>";
		}
			if ($state == "Tasmania") {
			$output[]= "<option>Australian Capital Territory</option>";
			$output[]= "<option>New South Wales</option>";
			$output[]= "<option>Northern Territory</option>";
			$output[]= "<option>Queensland</option>";
			$output[]= "<option>South Australia</option>";
			$output[]= "<option selected='selected'>Tasmania</option>";
			$output[]= "<option>Victoria</option>";
			$output[]= "<option>Western Australia</option>";
		}
			if ($state == "Victoria") {
			$output[]= "<option>Australian Capital Territory</option>";
			$output[]= "<option>New South Wales</option>";
			$output[]= "<option>Northern Territory</option>";
			$output[]= "<option>Queensland</option>";
			$output[]= "<option>South Australia</option>";
			$output[]= "<option>Tasmania</option>";
			$output[]= "<option selected='selected'>Victoria</option>";
			$output[]= "<option>Western Australia</option>";
		}
			if ($state == "Western Australia") {
			$output[]= "<option>Australian Capital Territory</option>";
			$output[]= "<option>New South Wales</option>";
			$output[]= "<option>Northern Territory</option>";
			$output[]= "<option>Queensland</option>";
			$output[]= "<option>South Australia</option>";
			$output[]= "<option>Tasmania</option>";
			$output[]= "<option>Victoria</option>";
			$output[]= "<option selected='selected'>Western Australia</option>";
		}
	$output[]= "</select>";
    $output[]= "</div>";
	
	
	
}

echo join('',$output);
		// Close the connection
					OCILogOff ($db);
					?>
					<p class="details">
					<a href="previousOrder.php">Click here to see your orders</a>
					</p>
                    
					
					
                    <div class="form_row">
					<input type="button" class="backbutton_input" value="Cancel" onclick="history.go(-1);" />
                    <input type="submit" class="login_input" value="Update"/>
                    </div>   
                  </form>     
                </div> 
            
            
            </div>	
            
              

            

            
        <div class="clear"></div>
            
            
        </div> <!-- end of content right -->
    
    	<div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->
    
    <?php include("inc/footer.php") ?>
    <!-- end of footer -->

</div> <!-- end of container -->

</body>
</html>