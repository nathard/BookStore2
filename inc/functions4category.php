<?php
function showCategory() {
	global $db;
	$category = $_SESSION['category'];
		
	if ($category) {
		$items = explode(',',$category);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] +1 :1;
		}
	
		foreach ($contents as $id=>$qty) {
		
			$sql = 'SELECT * FROM books WHERE CATEGORYID = '.$id;
			
			// modified
			$stmt = OCIParse($db, $sql); 
  
			if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			OCIExecute($stmt); 
			$Num_Rows = oci_fetch_all($stmt, $Result);

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


			//$count will be used to decide the number of record and will be used with odd $id to re-format templatemo_product_box
			$count = 0;
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
				$count++;
				if($id % 2 != 0)
					$output[]= '<div class="cleaner_with_width">&nbsp;</div>';
				else           
					$output[]= '<div class="cleaner_with_height">&nbsp;</div>';		
			}
			// re-format templatemo_product_box by $count 
			if($count % 2 !=0)				
				$output[sizeof($output)-1]= '<div class="cleaner_with_height">&nbsp;</div>';
			else
				$output[sizeof($output)-1]= '<div class="cleaner_with_width">&nbsp;</div>';
		}
		
		
		
	}
	
	else
		$output[] = '';
	//end of getting books details from database

		// show pages
		$output[] = '<p>';
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
		$output[] = '</p>';
	return join('',$output);
}

function showCategoryName() {
	global $db;
	$category = $_SESSION['category'];
	
	
		
	if ($category) {
		$items = explode(',',$category);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] +1 :1;
		}
		
		foreach ($contents as $id=>$qty) {
		
			$sql = 'SELECT * FROM category WHERE CATEGORYID = '.$id;
			
			// modified
			$stmt = OCIParse($db, $sql); 
  
			if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			OCIExecute($stmt); 

			while(OCIFetch($stmt)) {

				$categoryname= OCIResult($stmt,"CATEGORYNAME");
				$id = OCIResult($stmt,"CATEGORYID");
			
			}
					
			$output[] = $categoryname;

		}
		
	}
	else
		$output[] = '';
	return join('',$output);
}
?>