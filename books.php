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
<link rel="stylesheet" href="lightbox.css" type="text/css" media="screen" />
	
	<script src="js/prototype.js" type="text/javascript"></script>
	<script src="js/scriptaculous.js?load=effects" type="text/javascript"></script>
	<script src="js/lightbox.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/java.js"></script>
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
        <!-- end of content left -->
        
        <?php include("inc/leftcontent.php") ?>
        
        <!--right content-->
        <div id="templatemo_content_right">
		<div class="crumb_nav">
            <a href="index.php">Home</a> &gt;&gt; Books
            </div>	
        	
<?php			
		
			//get books details from database
		$sql = "SELECT * FROM books ORDER BY BOOKID";

		$stmt = OCIParse($db, $sql); 
		  
		if(!$stmt)  {
			echo "An error occurred in parsing the sql string.\n"; 
			exit; 
		  }
		OCIExecute($stmt); 		
		// get the total books for paging purpose and assign the total to Num_Rows variable
		$Num_Rows= oci_fetch_all($stmt, $Result);
		$Per_Page = 6;   // Per Page

		$Page = $_GET["Page"];
		if(!$_GET["Page"])
		{
			$Page=1;
		}

		$Prev_Page = $Page-1;
		$Next_Page = $Page+1;
		$Page_Start = (($Per_Page*$Page)-$Per_Page);
		if($Num_Rows<=$Per_Page)
		{
			$Num_Pages =1;
		}
		else if(($Num_Rows % $Per_Page)==0)
		{
			$Num_Pages =($Num_Rows/$Per_Page) ;
		}
		else
		{
			$Num_Pages =($Num_Rows/$Per_Page)+1;
			$Num_Pages = (int)$Num_Pages;
		}
		$Page_End = $Per_Page * $Page;
		if ($Page_End > $Num_Rows)
		{
			$Page_End = $Num_Rows;
		}
		
		for($i=$Page_Start;$i<$Page_End;$i++) {
		
				$id = $Result["BOOKID"][$i];
				$title = $Result["TITLE"][$i];
				$author = $Result["AUTHOR"][$i];
				$price = $Result["PRICE"][$i];
				$image = $Result["IMAGE"][$i];
				
				$output[]='<div class="templatemo_product_box">';
				$output[]= '<h1><a href="details.php?action=show&amp;id='.$id.'">'.$title.'</a></h1>';
				$output[]= '<div><a href="details.php?action=show&amp;id='.$id.'"><img src="images/'.$image.'" alt="" title="" border="0" height="150" width="100"/></a></div>';
                $output[]= '<div class="product_info">';
                
				
				$output[]='<div class="price"><strong>AUTHOR:</strong> <span>'.$author.'</span></div>';	
				//format number				
                $price = number_format($price, 2, '.', '');
				$output[]='<div class="price"><h3>$'.$price.'</h3>';
                $output[]= '<div class="buy_now_button"><a href="cart.php?action=add&amp;id='.$id.'">Buy Now</a></div>';
                $output[]= '<div class="detail_button"><a href="details.php?action=show&amp;id='.$id.'">Detail</a></div>';
                $output[]= '</div></div>';
                $output[]= '<div class="cleaner">&nbsp;</div>';
				$output[]= '</div>';
				if($id % 2 != 0)
					$output[]= '<div class="cleaner_with_width">&nbsp;</div>';
				else           
					$output[]= '<div class="cleaner_with_height">&nbsp;</div>';				
		}
//end of getting books details from database

		// show pages
		$output[] = '<div>';
		if($Num_Rows > 1 && $Num_Pages == 1)
			$output[]= 'Total: '.$Num_Rows.' Records - '.$Num_Pages.' Page :';
		else if($Num_Pages > 1 && $Num_Rows == 1)
			$output[]= 'Total: '.$Num_Rows.' Record - '.$Num_Pages.' Pages :';
		else if($Num_Pages > 1 && $Num_Rows > 1)
			$output[]= 'Total: '.$Num_Rows.' Records - '.$Num_Pages.' Pages :';		
		else	
			$output[]= 'Total: '.$Num_Rows.' Record - '.$Num_Pages.' Page :';

		if($Prev_Page)
		{
			$output[]= " <a href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page'><< Back</a> ";
		}

		for($i=1; $i<=$Num_Pages; $i++){
			if($i != $Page)
			{
				$output[]= "[ <a href='$_SERVER[SCRIPT_NAME]?Page=$i'>$i</a> ]";
			}
			else
			{
				$output[]= "<strong> $i </strong>";
			}
		}
		if($Page!=$Num_Pages)
		{
			$output[]= " <a href ='$_SERVER[SCRIPT_NAME]?Page=$Next_Page'>Next>></a> ";
		}
		$output[] = '</div>';
//show book details
echo join('',$output);
// Close the connection
OCILogOff ($db);
?>
      
       
            
            
        </div> <!-- end of content right -->
    
    	<div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->
    
    <?php include("inc/footer.php") ?>
    <!-- end of footer -->

</div> <!-- end of container -->

</body>
</html>