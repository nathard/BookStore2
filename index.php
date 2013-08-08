<?php 
//database connection
require_once('inc/DBConnect.php');
//functions for shopping cart
require_once('inc/functions4cart.php');
//functions for details
require_once('inc/functions4details.php');
//functions for category
require_once('inc/functions4category.php');
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
					// Close the connection
					OCILogOff ($db);
					?>
    <div id="templatemo_content">
    	<!--left content-->
    	
    	<?php include("inc/leftcontent.php") ?>
    	
        <!-- end of content left -->
        <!--right content-->
        <div id="templatemo_content_right">
        	<div class="templatemo_product_box">
            	
				<h1><a href="details.php?action=show&amp;id=7"><script type="text/javascript">displayTitle(6);</script></a></h1>
				<div><a href="details.php?action=show&amp;id=7"><img src="images/vb.jpg" alt="" title="" border="0" height="150" width="100"/></a></div>
                <div class="product_info">
                	
                  
				  <p><script type="text/javascript">displayShortDesc(6);</script></p>
				  <h3>$62.00</h3>
                    <div class="buy_now_button"><a href="cart.php?action=add&amp;id=7">Buy Now</a></div>
                    <div class="detail_button"><a href="details.php?action=show&amp;id=7">Detail</a></div>
                </div>
                <div class="cleaner">&nbsp;</div>
            </div>
            
            <div class="cleaner_with_width">&nbsp;</div>
            
            <div class="templatemo_product_box">
            	
				<h1><a href="details.php?action=show&amp;id=12"><script type="text/javascript">displayTitle(11);</script></a></h1>
				<div><a href="details.php?action=show&amp;id=12"><img src="images/ccnp.jpg" alt="" title="" border="0" height="150" width="100"/></a></div>    	    
                <div class="product_info">
                	
                    
					<p><script type="text/javascript">displayShortDesc(11);</script></p>
					<h3>$46.30</h3>
                    <div class="buy_now_button"><a href="cart.php?action=add&amp;id=12">Buy Now</a></div>
                    <div class="detail_button"><a href="details.php?action=show&amp;id=12">Detail</a></div>
                </div>
                <div class="cleaner">&nbsp;</div>
            </div>
            
            <div class="cleaner_with_height">&nbsp;</div>
            
            <div class="templatemo_product_box">
            	
				<h1><a href="details.php?action=show&amp;id=1"><script type="text/javascript">displayTitle(0);</script></a></h1>
				<div><a href="details.php?action=show&amp;id=1"><img src="images/wf.jpg" alt="" title="" border="0" height="150" width="100"/></a></div>       	    
                <div class="product_info">
                	
                    
					<p><script type="text/javascript">displayShortDesc(0);</script></p>
					<h3>$25.00</h3>
                    <div class="buy_now_button"><a href="cart.php?action=add&amp;id=1">Buy Now</a></div>
                    <div class="detail_button"><a href="details.php?action=show&amp;id=1">Detail</a></div>
                </div>
                <div class="cleaner">&nbsp;</div>
            </div>
            
           <div class="cleaner_with_width">&nbsp;</div>
			
			<div class="templatemo_product_box">
            	
				<h1><a href="details.php?action=show&amp;id=8"><script type="text/javascript">displayTitle(7);</script></a></h1>
				<div><a href="details.php?action=show&amp;id=8"><img src="images/xml.jpg" alt="" title="" border="0" height="150" width="100"/></a></div>
                <div class="product_info">
                	
                    
					<p><script type="text/javascript">displayShortDesc(7);</script></p>
					<h3>$20.00</h3>
                    <div class="buy_now_button"><a href="cart.php?action=add&amp;id=8">Buy Now</a></div>
                    <div class="detail_button"><a href="details.php?action=show&amp;id=8">Detail</a></div>
                </div>
                <div class="cleaner">&nbsp;</div>
            </div>
            
            <div class="cleaner_with_height">&nbsp;</div>
            
            
        </div> <!-- end of content right -->
    
    	<div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->
    
    <?php include("inc/footer.php") ?>
    <!-- end of footer -->

</div> <!-- end of container -->

</body>
</html>