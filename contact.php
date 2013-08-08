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
            <a href="index.php">Home</a> &gt;&gt; Contact Us
            </div>
			
            <h1>Contact Us</h1>
			<form method="post" name="contact" action="confirmcontact.php">        
        	<div class="feat_prod_box_details">
            <p class="details">
             If you have any question please leave us a message, we will reply as soon as possible
            </p>
            
              	<div class="contact_form">
                <div class="form_subtitle">all fields are required</div>          
                    <div class="form_row">
                    <label class="contact"><strong>Name:</strong></label>
                    <input type="text" class="contact_input" name="name" onblur="NameValidator(this.value);"/>
					<label id="NameError" class="errorMsg"></label>
                    </div>  

                    <div class="form_row">
                    <label class="contact"><strong>Email:</strong></label>
                    <input type="text" class="contact_input" name="email" onblur="EmailValidator(this.value);"/>
					<label id="MailError" class="errorMsg"></label>
                    </div>


                    <div class="form_row">
                    <label class="contact"><strong>Phone:</strong></label>
                    <input type="text" class="contact_input"  maxlength="12" name="phone" onblur="PhoneValidator(this.value);" onkeypress="return numbersonly(event,false);" />
					<label id="PhoneError" class="errorMsg"></label>
                    </div>
                    
                    <div class="form_row">
                    <label class="contact"><strong>Company:</strong></label>
                    <input type="text" class="contact_input" name="company" />
                    </div>


                    <div class="form_row">
                    <label class="contact"><strong>Message:</strong></label>
                    <p><textarea class="contact_textarea" cols="" rows="" name="message"></textarea></p>
                    </div>

                    
					<!--captcha input-->
					<label><strong>
					Type the characters you see in the picture below.</strong> </label>
					
					<div class="form_row">
					<label class="contact"><strong>Enter Code:</strong></label>
					<img src="captcha.php" alt="captcha"/>
					<input type="text" name="captcha" size="4" maxlength="4" onkeypress="return numbersonly(event,false);" /> <br />
					<input type="submit" name="submit" value="Submit" class="login_input"/>
					</div>

	

				</div>
            
            </div>	
            
              

            

            
        <div class="clear"></div>
            
            
        </div> <!-- end of content right -->
		</form>
    	<div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->
    
    <?php include("inc/footer.php") ?>
    <!-- end of footer -->

</div> <!-- end of container -->

</body>
</html>