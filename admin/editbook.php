<?php
	//link to other php file	
	require_once("connection.php");	
	session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Book Store Admin</title>
<meta name="keywords" content="Book Store, Books" />
<meta name="description" content="Book Store Administration" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />

<script type = "text/javascript">

// Form Validation

function validateEmpty(field)
{
	var x=field.value;
	if (x==null || x=="")
	  {
		field.style.backgroundColor="red";	
		return false;
	  }
	  else
	  {
		field.style.backgroundColor="white";	
		return true;
	  }
	  
}

function chkPrice() {
	var p = parseFloat(document.getElementById("price").value);
	p = p.toFixed(2);
	document.getElementById("price").value = p;	
	if (p == 'NaN')
	{
		document.getElementById("price").style.backgroundColor="red";	
	}
	else
	{
		document.getElementById("price").style.backgroundColor="white";
	}
} 

function validateQuantity()
{
	var field = document.getElementById("stock");
	
	if (!/^\d+$/.test(field.value)) { // is an integer
	   document.getElementById("stock").style.backgroundColor="red";
       return false;
    }
	else
	{
		document.getElementById("stock").style.backgroundColor="white";
		return true;
	}
}
function validateForm()
{	
	
	if (validateEmpty(document.getElementById("title"))==false)
	{
		return false
	}
	if (validateEmpty(document.getElementById("author"))==false)
	{
		return false
	}
	if (validateEmpty(document.getElementById("isbn1"))==false)
	{
		return false
	}
	if (validateEmpty(document.getElementById("isbn2"))==false)
	{
		return false
	}
	
	var price; 
	price = document.getElementById("price").value;	
	if (price == 'NaN' || price == '')
	{		
		result = false;	
	}
	if (validateQuantity() == false)
	{	
		return false;
	}
	return true;	

}
</script>

</head>
<body>
<!--  Content -->
<div id="templatemo_container">
	<!-- header -->
	<div id="templatemo_menu">
    	<ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="books.php">Books</a></li>
            <li><a href="orders.php">Orders</a></li>            
            <li><a href="users.php">Users</a></li>
    	</ul>
    </div> <!-- end of menu -->
    
    <div id="templatemo_header">
    </div> 
	<!-- end of header -->
    
    <div id="templatemo_content">
    	
        <div id="templatemo_content_left">
        	<div class="templatemo_content_left_section">
            	<h1>Tools</h1>
                <ul>
                    <li><a href="books.php">Books Admin</a></li>
                    <li><a href="orders.php">Orders Admin</a></li>
                    <li><a href="users.php">Users Admin</a></li>
            	</ul>
            </div>
			
            
            <div class="templatemo_content_left_section">                
                <a href="http://validator.w3.org/check?uri=referer"><img style="border:0;width:88px;height:31px" src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Transitional" width="88" height="31" vspace="8" border="0" /></a>
<a href="http://jigsaw.w3.org/css-validator/check/referer"><img style="border:0;width:88px;height:31px"  src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!" vspace="8" border="0" /></a>
			</div>
        </div> <!-- end of content left -->
        
        <div id="templatemo_content_right">
        	
		<h1><a href="index.php">Administration</a> --> <a href="books.php">Books</a> --> Book information</h1>
		<div class='contact_form'>
		
		
                
					
				
				<?php
					
					$bookid = strtoupper($_GET['bookid']); 
					if ($bookid != 0)
					{
						echo "<div class='form_subtitle'>Edit book information</div>";
						echo "<form name='updateInfo' action='updateinfo.php?action=1' method='post' enctype='multipart/form-data'>";
						$query = "SELECT * FROM books where BOOKID = " . $bookid;

						/* check the sql statement for errors and if errors report them */
						$stmt = OCIParse($connect, $query);

						if(!$stmt) {
							echo "An error occurred in parsing the sql string.\n";
							exit;
						}
						OCIExecute($stmt);					
						while (OCIFetch($stmt)){
							$mess="";
							$title = OCIResult($stmt,"TITLE");
							$category = OCIResult($stmt,"CATEGORYID");
							$author = OCIResult($stmt,"AUTHOR");
							$price = OCIResult($stmt,"PRICE");
							$stock = OCIResult($stmt,"QUANTITY");
							$isbn1 = OCIResult($stmt,"ISBN1");
							$isbn2 = OCIResult($stmt,"ISBN2");
							$year = OCIResult($stmt,"YEAR");
							$image = OCIResult($stmt,"IMAGE");
									
							echo "                
							<div class='form_row'>
							<label class='contact'><strong>Book ID:</strong></label>
							<input value='" . $bookid . "' class='contact_input' type='text' name='bookid' id='bookid' readonly='readonly'/>
							</div>
									
									<div class='form_row'>
								<label class='contact'><strong>Book Title:</strong></label>
								<input value='" . $title . "' class='contact_input' type='text' name='title' id='title' onblur = 'validateEmpty(this)' onchange = 'validateEmpty(this)'/>
							</div>
											
							
							<div class='form_row'>
								<label class='contact'><strong>Author:</strong></label>
								<input value='" . $author . "' class='contact_input' type='text' name='author' id='author' onblur = 'validateEmpty(this)' onchange = 'validateEmpty(this)'/>
							</div>
							
							
							<div class='form_row'>
								
								<label class='contact'><strong>Category:</strong></label>
								<select value='" . $category . "' class='contact_input' name='category' id='category'>";
							$sql = "SELECT * FROM category";

								/* check the sql statement for errors and if errors report them */
								$stmt1 = OCIParse($connect, $sql);

								if(!$stmt1) {
									echo "An error occurred in parsing the sql string.\n";
									exit;
								}
								OCIExecute($stmt1);
								while (OCIFetch($stmt1)){
									if ($category == OCIResult($stmt1,"CATEGORYID"))
									{
										$selected = " selected = 'selected'";
									}
									else
									{
										$selected = "";
									}
									
									echo "<option value='". OCIResult($stmt1,"CATEGORYID")."'". $selected .">". OCIResult($stmt1,"CATEGORYNAME") ."</option>";
									
								}
								echo "</select>";
						echo		"
							</div>
							
							
							<div class='form_row'>
								<label class='contact'><strong>ISBN:</strong></label>
								<input value='" . $isbn1 . "' class='contact_input' type='text' name = 'isbn1' id='isbn1' onblur = 'validateEmpty(this)' onchange = 'validateEmpty(this)'/>
							</div>
							
							<div class='form_row'>
								<label class='contact'><strong>ISBN2:</strong></label>
								<input value='" . $isbn2 . "' class='contact_input' type='text' name='isbn2' id='isbn2' onblur = 'validateEmpty(this)' onchange = 'validateEmpty(this)'/>
							</div>
							
							
							<div class='form_row'>
								<label class='contact'><strong>Year:</strong></label><select value='' class='contact_input' name='year' id='year'>";
								$currentYear = date('Y');
								for ($y = 1900; $y <= $currentYear; $y++)
								{
									if ($y == $year)
									{
										$selected = " selected = 'selected'";
									}
									else
									{
										$selected = "";
									}
									echo "<option value='". $y ."'". $selected .">". $y ."</option>";
								}								
						echo "
						</select></div>
							
							
							<div class='form_row'>
								<label class='contact'><strong>Price:</strong></label>
								<input value='" . $price . "' class='contact_input' type='text' name = 'price' id='price' onblur = 'chkPrice()' onchange = 'chkPrice()'/>
							</div>
							
							
							<div class='form_row'>
								<label class='contact'><strong>Stock:</strong></label>
								<input value='" . $stock . "' class='contact_input' type='text' name = 'stock' id='stock' onblur = 'validateQuantity()' onchange = 'validateQuantity()'/>
							</div>
							
							
							<div class='form_row'>
								<label class='contact'><strong>Image:</strong></label>
								<input value='' class='contact_input' type='file' name ='file' id='file'/>					
							</div>";
							
						}
						echo "
							<div class='form_row'>
								<input type='submit' class='login_input' value='Update' onclick = 'return validateForm()' />             
							</div>
						</form>";
					}
					else
					{
						echo "
						<div class='form_subtitle'>Add new book</div>
						<form name='addnewBook' action='updateinfo.php?action=2' method='post' enctype='multipart/form-data'>
						
						<div class='form_row'>
							<label class='contact'><strong>Book Title:</strong></label>
							<input value='' class='contact_input' type='text' name='title' id='title' onblur = 'validateEmpty(this)' onchange = 'validateEmpty(this)'/>
						</div>
										
						
						<div class='form_row'>
							<label class='contact'><strong>Author:</strong></label>
							<input value='' class='contact_input' type='text' name='author' id='author' onblur = 'validateEmpty(this)' onchange = 'validateEmpty(this)'/>
						</div>
						
						
						<div class='form_row'>
							<label class='contact'><strong>Category:</strong></label>
							<select value='' class='contact_input' name='category' id='category'>";
							$sql = "SELECT * FROM category";

								/* check the sql statement for errors and if errors report them */
								$stmt1 = OCIParse($connect, $sql);

								if(!$stmt1) {
									echo "An error occurred in parsing the sql string.\n";
									exit;
								}
								OCIExecute($stmt1);
								while (OCIFetch($stmt1)){
									echo "<option value='". OCIResult($stmt1,"CATEGORYID")."'>". OCIResult($stmt1,"CATEGORYNAME") ."</option>";
									//echo OCIResult($stmt1,"CATEGORYID");
								}
								echo "</select>";
						echo"
						</div>
						
						
						<div class='form_row'>
							<label class='contact'><strong>ISBN:</strong></label>
							<input value='' class='contact_input' type='text' name = 'isbn1' id='isbn1' onblur = 'validateEmpty(this)' onchange = 'validateEmpty(this)'/>
						</div>
						
						<div class='form_row'>
							<label class='contact'><strong>ISBN2:</strong></label>
							<input value='' class='contact_input' type='text' name='isbn2' id='isbn2' onblur = 'validateEmpty(this)' onchange = 'validateEmpty(this)'/>
						</div>
						
						
						<div class='form_row'>
							<label class='contact'><strong>Year:</strong></label>
							<select value='' class='contact_input' name='year' id='year'>";
							$currentYear = date('Y');
							for ($y = 1900; $y <= $currentYear; $y++)
							{
								echo "<option value='". $y ."'>". $y ."</option>";
							}
						echo "
						</select>
						</div>
						
						
						<div class='form_row'>
							<label class='contact'><strong>Price:</strong></label>
							<input value='' class='contact_input' type='text' name = 'price' id='price' onchange = 'chkPrice()'/>
						</div>
						
						
						<div class='form_row'>
							<label class='contact'><strong>Stock:</strong></label>
							<input value='' class='contact_input' type='text' name = 'stock' id='stock' onchange = 'validateQuantity()'/>
						</div>
						
						
						<div class='form_row'>
							<label class='contact'><strong>Image:</strong></label>
							<input value='' class='contact_input' type='file' name ='file' id='file'/>					
						</div>
						<div class='form_row'>
								<input type='submit' class='login_input' value='Insert' onclick = 'return validateForm()' />             
							</div>
						</form> ";
					}
										
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