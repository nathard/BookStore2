<?php

//database connection
require_once('inc/DBConnect.php');
//functions for shopping cart
require_once('inc/functions4cart.php');
//functions for details
require_once('inc/functions4details.php');
//start session
session_start();


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
            <a href="index.php">Home</a> &gt;&gt; Search
            </div>
			
            <h1><img src="images/Search32x32.png" alt="" title="" height="24px" width="24px"/>Search</h1>
			        
        	<div class="feat_prod_box_details">
            
             <!--add search bar-->
		
			 <div class="search_form">
			 <div class="form_subtitle">Search your online bookstore</div>
			 <form action ="search.php" method="get">			 
			 <div class="form_row">
			 
			 <div class="search_box">
			 <strong>Keywords:</strong>
			 <input type="text" id="AdvKeywordSearch"  name="search" size="55" onkeyup="displayResult4advSearch(this.value);" value=""/>
			<div id="advlivesearch" class="advlivesearch"></div>
			 </div>	 
			 
			 <div class="SearchFormatLeft_radio">
                    <label><input type="radio" name="find" value="all" checked="checked" /> All </label>
					
					<label><input type="radio" name="find" value="title"/> Title</label>
					
					<label><input type="radio" name="find" value="author" /> Author</label>
				
					<label><input type="radio" name="find" value="isbn" /> ISBN</label>
				</div>
            </div>
			 
			 <input type="submit" value="Search" class="login_input"/>
			 </form>
			 </div>
			 </div>	
			 <div style="float:left;">
            
 <?php 
				
$all = "all";				
$author = "author";
$title = "title";
$isbn = "isbn";
$choose = $_GET['find'];
$searchTerm = strtolower($_GET['search']);
$table = "books";

	
	switch ($choose) {
		case $author:
		$choose = "AUTHOR";
		break;
		case $isbn:
		$choose = "ISBN";
		break;
		case $title:
		$choose = "TITLE";
		break;
		default:		
		$choose = "ALL";
		}
//search all
	if($choose == "ALL") {
	global $db;
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
		echo "<br /><div style='color:#FF0000; margin-top:150px; margin-left:-450px;'><strong>No records returned!!</strong></div>";
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
				$output[] = '<p class="details"><script type="text/javascript">displayDesc('.$desc.');</script></p>';
                $output[]= '<div class="buy_now_button"><a href="cart.php?action=add&amp;id='.$id.'">Buy Now</a></div>';                
                $output[]= '</div>';
                $output[]= '<div class="cleaner">&nbsp;</div>';
		
			}else{			
			break;
			}
			
		
			}
	
		}
		$output[]= '';
	//show book details
				echo join('',$output);		
}

//search Title
	if($choose == "TITLE") {
	global $db;
	$query = "SELECT * FROM $table WHERE LOWER(TITLE) LIKE '%$searchTerm%'";	
		
	$stmt = OCIParse($db,$query);
	if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
	OCIExecute($stmt);
	$rows= OCIFetchStatement($stmt,$RowResult);

	if($rows==0)
	{
		echo "<br /><div style='color:#FF0000; margin-top:150px; margin-left:-450px; float:left;'><strong>No records returned!!</strong></div>";
	}else{	
	
	$query = "SELECT * FROM $table WHERE LOWER(TITLE) LIKE '%$searchTerm%'";	
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
				$output[] = '<p class="details"><script type="text/javascript">displayDesc('.$desc.');</script></p>';
                $output[]= '<div class="buy_now_button"><a href="cart.php?action=add&amp;id='.$id.'">Buy Now</a></div>';                
                $output[]= '</div>';
                $output[]= '<div class="cleaner">&nbsp;</div>';
		
			}else{
			break;
			}
			
		
			}
	
		}
		$output[]= '';
	//show book details
				echo join('',$output);		
}
//search Author
if($choose == "AUTHOR") {
	global $db;
	$query = "SELECT * FROM $table WHERE LOWER(AUTHOR) LIKE '%$searchTerm%'";	
	
		
	$stmt = OCIParse($db,$query);
	if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
	OCIExecute($stmt);
	$rows= OCIFetchStatement($stmt,$RowResult);

	if($rows==0)
	{
		echo "<br /><div style='color:#FF0000; margin-top:150px; margin-left:-450px; float:left;'><strong>No records returned!!</strong></div>";
	}else{	
	
	$query = "SELECT * FROM $table WHERE LOWER(AUTHOR) LIKE '%$searchTerm%'";	
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
				$output[] = '<p class="details"><script type="text/javascript">displayDesc('.$desc.');</script></p>';
                $output[]= '<div class="buy_now_button"><a href="cart.php?action=add&amp;id='.$id.'">Buy Now</a></div>';                
                $output[]= '</div>';
                $output[]= '<div class="cleaner">&nbsp;</div>';
				
			}else{
			break;
			}
			
		
			}
	
		}
		$output[]= '';
	//show book details
				echo join('',$output);		
}
//search isbn
if($choose == "ISBN") {
	global $db;
	$query = "SELECT * FROM $table WHERE LOWER(ISBN1) LIKE '%$searchTerm' OR LOWER(ISBN2) LIKE '%$searchTerm%'";
		
	$stmt = OCIParse($db,$query);
	if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
	OCIExecute($stmt);
	$rows= OCIFetchStatement($stmt,$RowResult);

	if($rows==0)
	{
		echo "<br /><div style='color:#FF0000; margin-top:150px; margin-left:-450px; float:left;'><strong>No records returned!!</strong></div>";
	}else{	
	
	$query = "SELECT * FROM $table WHERE LOWER(ISBN1) LIKE '%$searchTerm' OR LOWER(ISBN2) LIKE '%$searchTerm%'";
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
				$output[] = '<p class="details"><script type="text/javascript">displayDesc('.$desc.');</script></p>';
                $output[]= '<div class="buy_now_button"><a href="cart.php?action=add&amp;id='.$id.'">Buy Now</a></div>';                
                $output[]= '</div>';
                $output[]= '<div class="cleaner">&nbsp;</div>';
				
			}else{
			break;
			}
			
		
			}
	
		}
				$output[]= '';
				//show book details
				echo join('',$output);		
}
		//end of finding books by search term in database
		
		// Close the connection
		OCILogOff ($db);
			?>              

                       </div>
		</div> <!-- end of content right -->            
       
    
    	<div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->
    
    <?php include("inc/footer.php") ?>
    <!-- end of footer -->

</div> <!-- end of container -->

</body>
</html>