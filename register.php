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
<link rel="stylesheet" type="text/css" href="error.css" />
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
					// Close the connection
					OCILogOff ($db);
					?>
    <div id="templatemo_content">
    	<!--left content-->
    	
    	<?php include("inc/leftcontent.php") ?>
    	
        <!-- end of content left -->
        <!--right content-->
        <div id="templatemo_content_right">
        	<div class="crumb_nav">
            <a href="index.php">Home</a> &gt;&gt; Register
            </div>
			
            <h1>Register</h1>
			        
        	<div class="feat_prod_box_details">
            <p class="details">
             Please fill in this form to create a new account			 
            </p>
			
            
              	<div class="contact_form">
              		<div class="requiredField">* is required field</div>
                <div class="form_subtitle">create new account</div>
                 <form name="register" action="registerchecking.php" method="post">          
                     <div class="form_row">
                    <label class="contact"><strong>Username:<span class="asterisk">*</span></strong></label>
                    <input type="text" class="contact_input" name="username" maxlength="15" onblur="UserNameValidator(this.value);"/>
					<label id="UserNameError" class="errorMsg" ></label>
                    </div>  


                    <div class="form_row">
                    <label class="contact"><strong>Password:<span class="asterisk">*</span></strong></label>
                    <input type="password" class="contact_input" name="password" maxlength="25" onblur="PasswordValidator(this.value);"/>
					<label id="PasswordError" class="errorMsg" ></label>
                    </div> 

					<div class="form_row">
                    <label class="contact"><strong>Re-Password:<span class="asterisk">*</span></strong></label>
                    <input type="password" class="contact_input" name="repassword" maxlength="25"/>
                    </div> 
					
                    <div class="form_row">
                    <label class="contact"><strong>Email:<span class="asterisk">*</span></strong></label>
                    <input type="text" class="contact_input" name="email" id="email" maxlength="50" onblur="EmailValidator(this.value);"/>
					<label id="MailError" class="errorMsg" ></label>
                    </div>	


                    <div class="form_row">
                    <label class="contact"><strong>Phone:</strong></label>
                    <input type="text" class="contact_input" name="phone" maxlength="15" onblur="PhoneValidator(this.value);" onkeypress="return numbersonly(event,false);"/>
					<label id="PhoneError" class="errorMsg"></label>
                    </div>
                    
                    <div class="form_row">
                    <label class="contact"><strong>Company:</strong></label>
                    <input type="text" class="contact_input" name="company" maxlength="25"/>
                    </div>
                    
                    <div class="form_row">
                    <label class="contact"><strong>Address:</strong></label>
                    <input type="text" class="contact_input" name="address" maxlength="50" onblur="AddressValidator(this.value);"/>
					<label id="AddressError" class="errorMsg"></label>
                    </div>                    


                    <div class="form_row">
                    <label class="contact"><strong>State:<span class="asterisk">*</span></strong></label>
                    <select name="state">					  
					  <option>Australian Capital Territory</option>
					  <option>New South Wales</option>
					  <option>Northern Territory</option>
					  <option>Queensland</option>
					  <option>South Australia</option>
					  <option>Tasmanie</option>
					  <option>Victoria</option>
					  <option>Western Australia</option>
					</select>
					</div>
					
                    <div class="form_row">
                        <div class="terms">
                        <input type="checkbox" name="terms" value="accept"/>
                        I agree to the <a href="#" onclick="alert('It is not implemented!!');">terms &amp; conditions</a></div>
                    </div> 
					
                    <div class="form_row">
                    <input type="submit" class="login_input" value="register" />
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