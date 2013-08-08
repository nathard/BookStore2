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
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/loadXMLnXSL.js"></script>
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
            <a href="index.php">Home</a> &gt;&gt; <a href="userProfiles.php">My Account</a> &gt;&gt; My Orders
			
            </div>
			
            <h1>My Recent Orders</h1>
			        
        	<div class="feat_prod_box_details">
            <?php
		$sql = "SELECT * FROM users WHERE USERNAME='$username'";

		$stmt = OCIParse($db, $sql); 
		  
		if(!$stmt)  {
			echo "An error occurred in parsing the sql string.\n"; 
			exit; 
		  }
		OCIExecute($stmt); 
		
		
		while(OCIFetch($stmt)) {

			$Lname= OCIResult($stmt,"LASTNAME");
			$Fname = OCIResult($stmt,"FIRSTNAME");	
		}
		
		$output[] = "<p class='details'>";
        $output[] = "<strong style='color:#FFFFFF; font-size:15px'>Hello ".$Fname." ".$Lname."</strong><br /><br />";
		$output[] = "You can check your order status here";
        $output[] = "</p>";
		
			$output[] = "<table border = '1' class='details'>";
            $output[] = "<tr>";   
            $output[] = "<th>Order#</th>";
			$output[] = "<th>Date</th>";
            $output[] = "<th>Ship to</th>";
            $output[] = "<th>Order Total</th>";
			$output[] = "<th>Status</th>";
			$output[] = "<th>details</th>";
            $output[] = "</tr>";
		
		$sql = "SELECT * FROM orders WHERE USERNAME='$username' ORDER BY ORDERID";

		$stmt = OCIParse($db, $sql); 
		  
		if(!$stmt)  {
			echo "An error occurred in parsing the sql string.\n"; 
			exit; 
		  }
		OCIExecute($stmt); 
		

		while(OCIFetch($stmt)) {

			$orderID= OCIResult($stmt,"ORDERID");
			$username = OCIResult($stmt,"USERNAME");					
			$dateOrder = OCIResult($stmt,"DATEORDER");	
			$orderTotal = OCIResult($stmt,"ORDERTOTAL");
			$status = OCIResult($stmt,"STATUS");	
			

			$orderID= OCIResult($stmt,"ORDERID");		
               
			$output[] = "<tr>"; 
			$output[] = "<td>$orderID</td>";
			$output[] = "<td>$dateOrder</td>";
			$output[] = "<td>$Fname $Lname</td>";
			$output[] = "<td>$$orderTotal</td>";			
			$output[] = "<td>$status</td>";
			$output[] = "<td><a href='preOrderDetails.php?action=show&amp;id=".$orderID."'>View order</a></td>";
			$output[] = "</tr>";
			
			
		}
		$output[] = "</table>";
echo join('',$output);
				// Close the connection
					OCILogOff ($db);           			
?>
            
            
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