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

$cart = $_SESSION['cart'];
$action = $_GET['action'];

//check the username before making an order
if(empty($username)) {
	include "myaccount.php";
	print '<script type="text/javascript">';
	print 'alert("Please login before making an order")';
	print '</script>'; 
	exit;	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Book Store</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="error.css" />
<script src="js/FormEffect.js" type="text/javascript"></script>
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
            <a href="index.php">Home</a> &gt;&gt; Order
            </div>
			
            <h1>Order</h1>
			        	<div class="feat_prod_box_details">
        
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
			}
		?>    
            
            </div>

			<form name="OrderDetails" id="OrderDetails" action="orderform.php" method="post">        
        	<div class="feat_prod_box_details">
            <p class="details">
             Please fill in this from to make an order.			 
            </p>
            <div class="requiredField">* is required field</div>
              	<div class="contact_form">
                <div class="form_subtitle">Customer Details</div>
				
                
				<div id="Customer_Details">
                    <div class="form_row">
                    <label class="contact"><strong>First Name:<span class="asterisk">*</span></strong></label>
                    
					<?php
						echo '<input type="text" class="contact_input" name ="Fname" id="Fname" maxlength="20" value="';
						echo $Fname;
						echo '" onblur="FormValidator(this.value, Fname, FNameError);"/>';
					?>
					<label id="FNameError" class="errorMsg"></label>					
                    </div>


                    <div class="form_row">                    
					<label class="contact"><strong>Last Name:<span class="asterisk">*</span></strong></label>
                    
					<?php
						echo '<input type="text" class="contact_input" name="Lname" maxlength="20" value="';
						echo $Lname;
						echo '" onblur="LNameValidator(this.value);"/>';
					?>
					<label id="LNameError" class="errorMsg"></label>
                    </div> 

                    <div class="form_row">
                    <label class="contact"><strong>Email:<span class="asterisk">*</span></strong></label>
                    
					<?php
						echo '<input type="text" class="contact_input" name="email" maxlength="50" value="';
						echo $email;
						echo '" onblur="EmailValidator(this.value);" />';
					?>
					<label id="MailError" class="errorMsg"></label>
                    </div>


                    <div class="form_row">
                    <label class="contact"><strong>Phone:<span class="asterisk">*</span></strong></label>
                    
					<?php
						echo '<input type="text" class="contact_input" maxlength="12" name="phone" value="';
						echo $phone;
						echo '" onblur="PhoneValidator(this.value);" onkeypress="return numbersonly(event,false);" />';
					?>
					<label id="PhoneError" class="errorMsg"></label>
                    </div>
                    
                    <div class="form_row">
                    <label class="contact"><strong>Company:</strong></label>
                    
					<?php
						echo '<input type="text" class="contact_input" name="company" maxlength="25" value="';
						echo $company;
						echo '"/>';
					?>
                    </div>
                    
                    <div class="form_row">
                    <label class="contact"><strong>Adrress:<span class="asterisk">*</span></strong></label>
                    
					<?php
						echo '<input type="text" class="contact_input" name="address" maxlength="50" value="';
						echo $address;
						echo '" onblur="AddressValidator(this.value);"/>';
					?>
					<label id="AddressError" class="errorMsg"></label>
                    </div>                    
					
					<div class="form_row">
                    <label class="contact"><strong>City:<span class="asterisk">*</span></strong></label>
                    
					<?php
						echo '<input type="text" class="contact_input" name="city" maxlength="15" value="';
						echo $city;
						echo '" onblur="CityValidator(this.value);"/>';
					?>
					<label id="CityError" class="errorMsg"></label>
                    </div>
					
					
					<div class="form_row">
                    <label class="contact"><strong>Post Code:<span class="asterisk">*</span></strong></label>
                    
					<?php
						echo '<input type="text" class="contact_input" maxlength="5" name="postalCode" value="';
						echo $postcode;
						echo '" onblur="PostcodeValidator(this.value);" onkeypress="return numbersonly(event,false);" />';
					?>
					<label id="PcodeError" class="errorMsg"></label>
                    </div>				

                    <div class="form_row">
                    <label class="contact"><strong>State:<span class="asterisk">*</span></strong></label>
             
					
<?php
				$output[]='<select name="state">';
			if ($state == "Australian Capital Territory" || $state =="") {
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
			$output[] = '</select>';
			echo join('',$output);
			// Close the connection
					OCILogOff ($db);
?>
				
                    </div>
					
					
                    <div class="form_row">
					<input type="button" class="backbutton_input" value="Back" onclick="history.go(-1);" />
                    <input type="button" class="login_input" value="Continue" onclick="Display_Hide('Deliver_Address','Customer_Details');"/>
                    </div>   
                  <!--</form>-->
				  </div>
                </div>  
            
            
            
            </div>	
            
              

            

		<div class="feat_prod_box_details">
            <p class="details">
             
            </p>
            
              	<div class="contact_form">
                <div class="form_subtitle">Deliver Address</div>
                 <!--deliver info-->
				 <div id="Deliver_Address" style="display:none">
					<div class="form_row">
                    <label class="contact"><strong>First Name:<span class="asterisk">*</span></strong></label>
                    <input type="text" class="contact_input" name ="DFname" id="DFname" maxlength="20" onblur="DFNameValidator(this.value);"/>
					<label id="DFNameError" class="errorMsg"></label>					
                    </div>


                    <div class="form_row">                    
					<label class="contact"><strong>Last Name:<span class="asterisk">*</span></strong></label>
                    <input type="text" class="contact_input" name="DLname" maxlength="20" onblur="DLNameValidator(this.value);"/>
					<label id="DLNameError" class="errorMsg"></label>
                    </div> 
					
                    <div class="form_row">
                    <label class="contact"><strong>UnitNo:<span class="asterisk">*</span></strong></label>
                    <input type="text" class="contact_input" name="unitNo" maxlength="4" onblur="UnitValidator(this.value);" onkeypress="return numbersonly(event,false);" />
					<label id="UnitError" class="errorMsg"></label>
                    </div>  


                    <div class="form_row">
                    <label class="contact"><strong>Street:<span class="asterisk">*</span></strong></label>
                    <input type="text" class="contact_input" name="street" maxlength="30" onblur="StreetValidator(this.value);" />
					<label id="StreetError" class="errorMsg"></label>
                    </div> 

                    <div class="form_row">
                    <label class="contact"><strong>City:<span class="asterisk">*</span></strong></label>
                    <input type="text" class="contact_input" name="Dcity" maxlength="15" onblur="DCityValidator(this.value);" />
					<label id="DCityError" class="errorMsg"></label>
                    </div>


                    <div class="form_row">
                    <label class="contact"><strong>Post Code:<span class="asterisk">*</span></strong></label>
                    <input type="text" class="contact_input" maxlength="5" name="DpostalCode" onblur="DPostcodeValidator(this.value);" onkeypress="return numbersonly(event,false);"  />
					<label id="DPcodeError" class="errorMsg"></label>
                    </div>
                    
                    <div class="form_row">
                    <label class="contact"><strong>State:</strong></label>
                    <select name="Dstate">					  
					  <option>Australian Capital Territory</option>
					  <option>New South Wales</option>
					  <option>Northern Territory</option>
					  <option>Queensland</option>
					  <option>South Australia</option>
					  <option>Tasmania</option>
					  <option>Victoria</option>
					  <option>Western Australia</option>
					</select>
                    </div>          
                                        
					
                    <div class="form_row">					
					<input type="button" class="backbutton_input" value="Back" onclick="Display_Hide('Customer_Details','Deliver_Address');" />
					<input type="button" class="login_input" value="Continue" onclick="Display_Hide('Payment_Method','Deliver_Address');" />					
                    </div>   
                  <!--end of deliver info     -->
				  </div>
                </div>  
            
          </div>	
		  
		  
		  
          <div class="feat_prod_box_details">
            <p class="details">
             
            </p>
			<div class="contact_form">
                <div class="form_subtitle">Payment Details</div>
                 <!--payment details -->
				 <div id="Payment_Method" style="display:none">
			<div class="form_row">
                    <label class="contact"><strong>Method:</strong></label>
                    <select name="cardType">					  
					  <option>Amex</option>
					  <option>Diners Club</option>
					  <option>Master Card</option>
					  <option>Visa Card</option>
					</select>
                    </div>                   

			
			<div class="form_row">
                    <label class="contact"><strong>CardNo:<span class="asterisk">*</span></strong></label>
                    <input type="text" class="contact_input" maxlength="16" name="cardNo" onblur="CCValidator(this.value);" onkeypress="return numbersonly(event,false);" />
					<label id="CCError" class="errorMsg"></label>
                    </div>
			
			
			<div class="form_row">
                    <label class="contact"><strong>Expire Date:<span class="asterisk">*</span></strong></label>
                    <select name="expDate">					  
					  <option>01</option>
					  <option>02</option>
					  <option>03</option>
					  <option>04</option>
					  <option>05</option>
					  <option>06</option>
					  <option>07</option>
					  <option>08</option>
					  <option>09</option>
					  <option>10</option>
					  <option>11</option>
					  <option>12</option>
					</select>&nbsp;&#47;&nbsp;
					<input type="text"  size="5" maxlength="2" name="year" id="year" onblur="yearValidator(this.value);" onkeypress="return numbersonly(event,false);" value="Year" onfocus="effect_in_textbox('year','Year');" />					
                    <label id="yearError" class="errorMsg"></label>
					</div>
			
			<div class="form_row">
                    <label class="contact"><strong>CSC:<span class="asterisk">*</span></strong></label>
                    <input type="text" size="3" maxlength="3" name="csc" onblur="CSCValidator(this.value);" onkeypress="return numbersonly(event,false);" /><br/>
					<label id="CSCError" class="errorMsg"></label>
                    </div>
            
			
            <div class="form_row">
					<input type="button" class="backbutton_input" value="Back" onclick="Display_Hide('Customer_Details','Payment_Method');" />
                    <input type="submit" class="login_input" value="Continue" />
                    </div>   
                 <!--end of payment details -->
				 </div>
                </div>  
            
          </div>	    		  
		  </form>
            
        <div class="clear"></div>
            
            
        </div> <!-- end of content right -->
    
    	<div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->
    
    <?php include("inc/footer.php") ?>
    <!-- end of footer -->

</div> <!-- end of container -->

</body>
</html>