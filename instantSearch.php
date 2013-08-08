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
            <a href="index.php">Home</a> &gt;&gt; Search
            </div>	
        	
<?php			
		// find books by search term in database
	global $db;
	$table="books";
	$searchTerm = strtolower($_GET['instantSearch']);
	$query = "SELECT * FROM $table WHERE LOWER(TITLE) LIKE '%$searchTerm%' OR LOWER(AUTHOR) LIKE '%$searchTerm%' OR LOWER(ISBN1) LIKE '%$searchTerm%' OR LOWER(ISBN2) LIKE '%$searchTerm%'";	
	$stmt = OCIParse($db,$query);
	
	if(!$stmt)  {
		echo "An error occurred in parsing the sql string.\n"; 
		exit; 
	}
	OCIExecute($stmt);
	$rows= OCIFetchStatement($stmt,$RowResult);
	if($rows==0)
	{
		$output[]= 'Sorry, we did not find any results for your search.<br />';
		$output[]= 'You searched for: <strong>'.$searchTerm.'</strong>';
	}else{
	$query = "SELECT * FROM $table WHERE LOWER(TITLE) LIKE '%$searchTerm%' OR LOWER(AUTHOR) LIKE '%$searchTerm%' OR LOWER(ISBN1) LIKE '%$searchTerm%' OR LOWER(ISBN2) LIKE '%$searchTerm%'";	
	$stmt = OCIParse($db,$query);
	if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
	OCIExecute($stmt);
	
		while(OCIFetch($stmt)) {
			
			$title= OCIResult($stmt,"TITLE");
			$author = OCIResult($stmt,"AUTHOR");	
			$publisher = OCIResult($stmt,"PUBLISHER");
			$isbn1 = OCIResult($stmt,"ISBN1");
			$isbn2 = OCIResult($stmt,"ISBN2");
			$year = OCIResult($stmt,"YEAR");
			$price = OCIResult($stmt,"PRICE");
			$id = OCIResult($stmt,"BOOKID");
			$image = OCIResult($stmt,"IMAGE");
			$desc= $id-1;
			
			if($searchTerm != NULL) {
			$output[]= '<h1><a href="details.php?action=show&amp;id='.$id.'">'.$title.'</a></h1>';
				$output[]= '<div class="image_panel"><a href="details.php?action=show&amp;id='.$id.'"><img src="images/'.$image.'" alt="" title="" border="0" height="140" width="100"/></a></div>';
                $output[]= '<div class="product_info">';
                
				
				$output[]='<div class="price"><strong>AUTHOR:</strong> <span >'.$author.'</span></div>';	
				$output[]='<div class="price"><strong>PUBLISHER:</strong> <span >'.$publisher.'</span></div>';
				$output[]='<div class="price"><strong>ISBN:</strong> <span >'.$isbn1.', '.$isbn2.'</span></div>';					
				$output[]='<div class="price"><strong>YEAR:</strong> <span>'.$year.'</span></div>';				
                $output[]='<div class="price"><strong>PRICE:</strong> <span >$'.$price.'</span></div>';
				$output[]= '<p class="details"><script type="text/javascript">displayDesc('.$desc.');</script></p>';
                $output[]= '<div class="buy_now_button"><a href="cart.php?action=add&amp;id='.$id.'">Buy Now</a></div>';                
                $output[]= '</div>';
                $output[]= '<div class="cleaner">&nbsp;</div>';
				
			}else{			
				$output[]= 'Sorry, we did not find any results for your search.<br />';
				$output[]= 'You searched for: <strong>'.$searchTerm.'</strong>';
				break;
			}
			
		
			}
	
		}
		//end of finding books by search term in database
		$output[]= '';
		//show book details
		echo join('',$output);
		// Close the connection
		OCILogOff ($db);
?>
      
       
            
            
        </div> <!-- end of content right -->
		<div class="clear"></div>
            
            
   
    
    	<div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->
    
	<?php include("inc/footer.php") ?>
    <!-- end of footer -->

</div> <!-- end of container -->

</body>
</html>