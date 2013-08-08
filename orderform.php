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
/******************check cart***************************/
	if (empty($cart)) {
		include "books.php";
		$output[]= '<script type="text/javascript">';
		$output[]= 'alert("Your cart is empty")';
		$output[]= '</script>'; 
		echo join('',$output);
		exit;
	}
	/**********************get the next OrderNo in orders table**************************/
	
	$orderNoQuery = "SELECT * FROM orders";
			$orderNoCheck = OCIParse($db,$orderNoQuery);
			if(!$orderNoCheck)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			}
			OCIExecute($orderNoCheck);
			$rows= OCIFetchStatement($orderNoCheck,$result);
	
	
	/************************get value from order form***********************/
			//Customter details
			$Fname = $_POST['Fname'];
			$Lname = $_POST['Lname'];
			$email = $_POST['email'];    
			$address = $_POST['address'];
			$phone = $_POST['phone'];
			$company = $_POST['company'];
			$state = $_POST['state'];
			$postcode = $_POST['postalCode'];
			$city = $_POST['city'];
			
			//deliver details
			$DFname = $_POST['DFname'];
			$DLname = $_POST['DLname'];
			$Dstate = $_POST['Dstate'];
			$Dpostcode = $_POST['DpostalCode'];
			$Dcity = $_POST['Dcity'];
			$unitNo = $_POST['unitNo'];
			$street = $_POST['street'];
			$status = "pending";
			$orderID = $rows +1;
			$username = $_SESSION['username'];
			$date = date("d-M-Y",time());
			
			//payment method
			$cardType = $_POST['cardType'];
			$cardNo = $_POST['cardNo'];
			$expDate = $_POST['expDate'];
			$year = $_POST['year'];
			$csc = $_POST['csc'];
			
			
	/***********************check if all required fields****************/
	// in customer details form
//htmlentities
if(!preg_match("/^[a-zA-Z]{1,}$/",htmlentities($Fname))) {
		include "order.php";
		print '<script type="text/javascript">';
		print 'alert("Your first name is invalid")';
		print '</script>'; 
		exit;
}

if(!preg_match("/^[a-zA-Z]{1,}$/",htmlentities($Lname))) {
		include "order.php";
		print '<script type="text/javascript">';
		print 'alert("Your last name is invalid")';
		print '</script>'; 
		exit;
}

	if(!preg_match("/^[0-9]{1,}+[a-zA-Z0-9]{0,}+[ ]{1}+[a-zA-Z0-9[ ]{1,}$/",htmlentities($address))) {
		include "order.php";
		print '<script type="text/javascript">';
		print 'alert("Your address is invalid")';
		print '</script>'; 
		exit;
	}
	
	if (!preg_match("/^[a-zA-Z]{3,}$/", htmlentities($city))){
		include "order.php";
		print '<script type="text/javascript">';
		print 'alert("Your city is invalid")';
		print '</script>'; 
		exit;
	}
	
	if (!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/", htmlentities($email))) {
 
	include "order.php";
	print '<script type="text/javascript">';
	print 'alert("The email address '. $email.' is invalid")';
	print '</script>'; 
	exit;
	}
	
	if(!preg_match("/^[0-9]{8,}$/",htmlentities($phone))) {
		include "order.php";
		print '<script type="text/javascript">';
		print 'alert("Your phone is invalid")';
		print '</script>'; 
		exit;
	}

if(!empty($company)) {
	if(!preg_match("/^[[:alnum:] ]{0,25}$/i",htmlentities($company))) {
		include "order.php";
		print '<script type="text/javascript">';
		print 'alert("Your company is invalid")';
		print '</script>'; 
		exit;
	}
}
	
	if(empty($Fname) || empty($Lname) || empty($email) || empty($state) || empty($postcode) || empty($city) || empty($address) || empty($phone)) {
				include "order.php";
				print '<script type="text/javascript">';
				print 'alert("Please fill in all required fields")';
				print '</script>'; 				
				exit;
	}
	//in deliver details form
	//htmlentities
	if(!preg_match("/^[a-zA-Z]{1,}$/",htmlentities($DFname))) {
		include "order.php";
		print '<script type="text/javascript">';
		print 'alert("Your first name is invalid")';
		print '</script>'; 
		exit;
}

	if(!preg_match("/^[a-zA-Z]{1,}$/",htmlentities($DLname))) {
		include "order.php";
		print '<script type="text/javascript">';
		print 'alert("Your last name is invalid")';
		print '</script>'; 
		exit;
	}
	
	if (!preg_match("/^[a-zA-Z]{3,}$/", htmlentities($Dcity))){
		include "order.php";
		print '<script type="text/javascript">';
		print 'alert("Your city is invalid")';
		print '</script>'; 
		exit;
	}
		
	if (!preg_match("/^[a-zA-Z0-9 ]{3,}$/", htmlentities($street))){
		include "order.php";
		print '<script type="text/javascript">';
		print 'alert("Your street is invalid")';
		print '</script>'; 
		exit;
	}
	
	if (!preg_match("/^[0-9]{1,}+[a-zA-Z0-9]{0,}$/", htmlentities($unitNo))){
		include "order.php";
		print '<script type="text/javascript">';
		print 'alert("Your unitNo is invalid")';
		print '</script>'; 
		exit;
	}
	
	if(empty($DFname) || empty($DLname) || empty($Dstate) || empty($Dpostcode) || empty($Dcity) || empty($unitNo) || empty($street)) {
				include "order.php";
				print '<script type="text/javascript">';
				print 'alert("Please fill in all required fields")';
				print '</script>'; 				
				exit;
	}
	//in payment method form
	if(strlen($_POST['cardNo']) != 16 || strlen($year) !=2 || strlen($_POST['csc']) != 3) {
				include "order.php";
				print '<script type="text/javascript">';
				print 'alert("Please fill in all required fields")';
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
			        
        	
            <?php	
		/*******************get items in cart**************************/	
global $db;
	$cart = $_SESSION['cart'];	
if ($cart) {
$items = explode(',',$cart);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
foreach ($contents as $id=>$qty) {
		
			$sql = 'SELECT * FROM books WHERE BOOKID = '.$id;
			
			// modified
			$stmt = OCIParse($db, $sql); 
  
			if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			OCIExecute($stmt); 

			while(OCIFetch($stmt)) {

				$title= OCIResult($stmt,"TITLE");				
				$price = OCIResult($stmt,"PRICE");
				$id = OCIResult($stmt,"BOOKID");
				$image = OCIResult($stmt,"IMAGE");
										
			}
			
			 
					$total += $price * $qty;
		
					
		}
		$shippingfee = 20;
		$total += $shippingfee;
					
}

	/*********************get total and quantity & add in orders, users, orderSummary tables***************************************/		
			$totalorder = $total;
			//update information for user details
			$Query = "UPDATE users SET FIRSTNAME = '$Fname', LASTNAME = '$Lname', EMAIL = '$email', PHONE = '$phone', COMPANY = '$company', ADDRESS = '$address', POSTCODE = '$postcode', CITY = '$city', STATE = '$state' WHERE USERNAME='$username'";
			$stmt = OCIParse($db,$Query);
			if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			OCIExecute($stmt);
	
			/****************add new orders************************/
			$addOrderQuery = "INSERT INTO orders VALUES ($orderID, '$username', '$date', $totalorder, '$status', '$DFname', '$DLname', $unitNo, '$street', '$Dcity', $Dpostcode, '$Dstate','$cardType','$cardNo','$csc', $expDate, $year)";
			$addOrderParse = OCIParse($db, $addOrderQuery);
			if(!$addOrderParse)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			OCIExecute($addOrderParse);
			
			/**********************add books and quantity into orderSummary***********************/
			foreach ($contents as $id=>$qty) {
			$bookid = $id;
			$bookqty = $qty;
		
			$addOrderSummaryQuery = "INSERT INTO orderSummary VALUES ($orderID, $id, $bookqty)";
			$addOrderSummaryParse = OCIParse($db, $addOrderSummaryQuery);
			if(!$addOrderSummaryParse)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			OCIExecute($addOrderSummaryParse);
			}
			
			/*---------------------order output-------------------*/
			 
			 
				$output[] = '<div class="title"><span class="title_icon"></span>Order#'.$orderID.' Details</div>';
        		$output[] = '<div class="feat_prod_box_details">';
		
              	$output[] = '<div class="contact_form">';
				$output[] = '<div class="form_subtitle">Billing Address</div>';
				$output[] = '<br /><strong>Name: </strong>';
				$output[] = $Fname;
				$output[] = '&nbsp;';
				$output[] = $Lname;
				$output[] = '<br /><strong>Address: </strong>'.$address;
				$output[] = '<br /><strong>Postcode: </strong>'.$postcode;
				$output[] = '<br /><strong>City: </strong>'.$city;
				$output[] = '<br /><strong>State: </strong>'.$state;
				$output[] = '<br /><strong>Date: </strong>'.$date;
				$output[] = '</div>';
				
				$output[] = '<div class="contact_form">';
				$output[] = '<div class="form_subtitle">Shipping Address</div>';
				$output[] = '<br /><strong>Name: </strong>';
				$output[] = $DFname;
				$output[] = '&nbsp;';
				$output[] = $DLname;
				$output[] = '<br /><strong>Address: </strong>';
				$output[] = $unitNo;
				$output[] = '&nbsp;';
				$output[] = $street;
				$output[] = '<br /><strong>Postcode: </strong>'.$Dpostcode;
				$output[] = '<br /><strong>City: </strong>'.$Dcity;
				$output[] = '<br /><strong>State: </strong>'.$Dstate;
				//$output[] = '<br /><strong>Date: </strong>'.$date;
				$output[] = '</div>';
				
				$output[] = '<div class="contact_form">';
				$output[] = '<div class="form_subtitle">Products</div>';
				$output[] = '<table border = "1" class="details">';
					$output[] = '<tr>';   
					$output[] = '<th>Product Name</th>';
					$output[] = '<th>Price</th>';
					$output[] = '<th>Quantity</th>';
					$output[] = '<th>Sub Total</th>';					
					$output[] = '</tr>';
				foreach ($contents as $id=>$qty) {
					$bookid = $id;
					$bookqty = $qty;
					
					
					$booksQuery = 'SELECT * FROM books WHERE BOOKID = '.$bookid;
					$booksQueryParse = OCIParse($db, $booksQuery); 
  
					if(!$booksQueryParse)  {
						echo "An error occurred in parsing the sql string.\n"; 
						exit; 
					  }
					OCIExecute($booksQueryParse);

					while (OCIFetch($booksQueryParse)) {
						$bookID = OCIResult($booksQueryParse,"BOOKID");
						$author = OCIResult($booksQueryParse,"AUTHOR");
						$isbn1 = OCIResult($booksQueryParse,"ISBN1");
						$isbn2 = OCIResult($booksQueryParse,"ISBN2");
						$title = OCIResult($booksQueryParse,"TITLE");
						$publisher = OCIResult($booksQueryParse,"PUBLISHER");
						$year = OCIResult($booksQueryParse,"YEAR");
						$price = OCIResult($booksQueryParse,"PRICE");
						$image = OCIResult($booksQueryParse,"IMAGE");
						
						$output[] = '<tr>';
						$output[] = '<td>'.$title.'</td>';
						$output[] = '<td>$'.$price.'</td>';
						$output[] = '<td>'.$qty.'</td>';
						$output[] = '<td><strong><span style="float:right;">$'.($price*$qty).'</span></strong></td>';
						$output[] = '</tr>';
						
					
					}
				
					
				
				}
					$shipping = 20;
					
					$output[] = '<tr>';
					$output[] = '<td colspan="3"><strong>Shipping Fee:</strong></td>';
					$output[] = '<td><strong><span style="float:right;">$'.$shipping.'<span></strong></td>';
					$output[] = '</tr>';
					$output[] = '<tr>';
					$output[] = '<td colspan="3"><strong>Total:</strong></td>';
					$output[] = '<td><strong><span style="float:right;">$'.$total.'<span></strong></td>';
					$output[] = '</tr>';
					$output[] = '</table>';
					$output[] = '</div>';
					$output[] = '</div>';
					echo join('',$output);
					$cart ="";	
	// Close the connection
					OCILogOff ($db);					
?>
            
            
            
        <div class="clear"></div>
            
            
			<div></div>
			<div class="warning4orderform"><br />THANKS FOR SHOPPING AT OUR STORE!!!!!!</div>
        </div> <!-- end of content right -->
<?php
// mail user their information

$mysite = 'www.bookstore.com';
$admin = 'Book Store admin';
$myemail = 'nlha@deakin.edu.au';

$subject = "Book Store Order Id:  $orderID...";
$message = "Dear $username, you have just purchased at our web site.  
    Your Order ID is: $orderID
						
	
    Thanks you,
    $admin";
    
mail($email, $subject, $message, "From: $mysite <$myemail>\nX-Mailer:PHP/" . phpversion());

$mysite = 'www.bookstore.com';
$admin = 'Book Store Admin';
$myemail = 'nlha@deakin.edu.au';

$subject = "Book Store Order Id:  $orderID...";
$message = "Customer: $username has just purchased at our store.  
    The Order ID is: <a href='#'><strong>$orderID</strong></a>";
	//We can add hyperlink to re-direct to order status of admin page
    
mail($email, $subject, $message, "From: $mysite <$myemail>\nX-Mailer:PHP/" . phpversion());
?>
    	<div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->
    
    <?php include("inc/footer.php") ?>
    <!-- end of footer -->

</div> <!-- end of container -->

</body>
</html>