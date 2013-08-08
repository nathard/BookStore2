<?php
function writeShoppingCart() {
	$cart = $_SESSION['cart'];
	if (!$cart) {
		return '<p>You have no items in your shopping cart</p>';
	} else {
		// Parse the cart session variable
		$items = explode(',',$cart);
		$s = (count($items) > 1) ? 's':'';
		return '<p>You have <a href="cart.php">'.count($items).' item'.$s.' in your shopping cart</a></p>';
	}
}

function showCart() {
	global $db;
	$cart = $_SESSION['cart'];
	
	$output[] = '<form action="cart.php?action=update" method="post" id="cart">';
	
		$output[] = '<table class="cart_table">';
        $output[] = '<tr class="cart_title">';
        $output[] = '<td>Item pic</td>';
        $output[] = '<td>Book name</td>';
        $output[] = '<td>Unit price</td>';
        $output[] = '<td>Qty</td>';
        $output[] = '<td>Total</td>';               
        $output[] = '</tr>';
		
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
			
			$output[] = '<tr>';
					$output[] = '<td><a href="details.php?action=show&amp;id='.$id.'"><img src="images/'.$image.'" alt="" title="" border="0" class="cart_thumb" height="140" width="92"/></a><br />';
					$output[] = '<a href="cart.php?action=delete&amp;id='.$id.'" class="r">Remove</a></td>';
					$output[] = '<td>'.$title.'</td>';
					//format number
					$price = number_format($price, 2, '.', '');
                    $output[] = '<td>$'.$price.'</td>';
                    $output[] = '<td><input type="text" name="qty'.$id.'" value="'.$qty.'" size="1" maxlength="3" /></td>';
					$subtotal = ($price * $qty);
					//format number
					$subtotal = number_format($subtotal, 2, '.', '');
                    $output[] = '<td>$'.$subtotal.'</td>'; 					
					$total += $subtotal ;
					$output[] = '</tr>';
			
		}
		
			$shippingfee = 20;
			//format number
				$shippingfee = number_format($shippingfee, 2, '.', '');
					$total = $total + $shippingfee;
		$output[] = '<tr>';
        $output[] = '<td colspan="4" class="cart_total"><span class="red">TOTAL SHIPPING:</span></td>';
        $output[] = '<td>$'.$shippingfee.'</td>';                
        $output[] = '</tr>';  
                
                $output[] = '<tr>';
                $output[] = '<td colspan="4" class="cart_total"><span class="red">TOTAL:</span></td>';
				//format number
				$total = number_format($total, 2, '.', '');
                $output[] = '<td>$'.$total.'</td>';
				$output[] = '</tr>';
		$output[] = '</table>';
		$output[] = '<br />';
		
		$output[] = '<label><a href="books.php" class="continue">&lt; continue</a></label>';		
		$output[] = '<label><button type="submit"  class="update">Update</button></label>';
		$output[] = '<label><a href="order.php" class="checkout">checkout &gt;</a></label>';
		
		
	} else {
		$output[] = '<tr>';
		$output[] = '<td>N/A</td>';
		$output[] = '<td>N/A</td>';
		$output[] = '<td>N/A</td>';
		$output[] = '<td>N/A</td>';
		$output[] = '<td>N/A</td>';
		$output[] = '</tr>';
		$output[] = '</table>';
		$output[] = '<p>Your shopping cart is empty.</p>';
		$output[] = '<label><a href="books.php" class="continue">&lt; continue</a></label>';		
		$output[] = '<label><button type="submit"  class="update">Update</button></label>';
		$output[] = '<label><a href="#" class="checkout" onclick="show_alert();">checkout &gt;</a></label>';
		//$output[] = '</form>';
		
	}	
	$output[] = '</form>';
	return join('',$output);
}

function showTotal4RightContent() {	
global $db;
	$cart = $_SESSION['cart'];
	$output[] = '<div class="cart">';
                  $output[] = '<div class="title"><span class="title_icon"><img src="images/cart.gif" alt="" title="" /></span></div><br /><br />';
                  $output[] = '<div class="home_cart_content">';
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
			
			//$output[] = '<tr>';
					
					$total += $price * $qty;
			
					
		}
					$shippingfee = 20;
					//format number
					$shippingfee = number_format($shippingfee, 2, '.', '');
					$total = $total + $shippingfee;
					$items = explode(',',$cart);
					$s = (count($items) > 1) ? 's':'';
					//format number
					$total = number_format($total, 2, '.', '');
					$output[] = count($items).' item'.$s.' | <span class="red">TOTAL: $'.$total.'</span>';

				  
} else {	
		$output[] = '0 x items | <span class="red">TOTAL: $0.00</span>';
	
	}
	$output[] = '</div>';
                  $output[] = '<a href="cart.php" class="view_cart">view cart</a>';
              
              $output[] = '</div>';
	return join('',$output);
}
?>
