<?php
	//link to other php file	
	require_once("connection.php");	
	session_start();
?>

<?php include("inc/header.php") ?> 
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
		
		<h1><a href="index.php">Administration</a> --> Books</h1>
		
		<div>    
			<div class="feat_prod_box_details">
                <form name='searchBook' action='books.php' method='post'>
				<div class='form_row'>
					<h2>Search order by orderID</h2>
						<input type='text' name='title' id='title' class='contact_input'/>   
                        <input type='submit' value='search' /><br />
                        <a href="editbook.php?bookid=0"> Add a new book </a><br />
                        <a href="insertfromxml.php"> Add book from XML file</a>
                </div>
                </form>
            </div>  
             
                
                
				
				<?php
                $mess="There is no book match your search condition.";
                //get search info
                $title = strtoupper($_POST['title']);  
					
                if (!$title == "")
				{
					
					
					//build searching condition
					$strSearch = "";
					
					$strSearch .= "upper(title) like '%". $title ."%'";
												  
					/* build sql statement using form data */
					$query = "SELECT * FROM books where " . $strSearch;

					/* check the sql statement for errors and if errors report them */
					$stmt = OCIParse($connect, $query);
					
					//echo $query;
					
					if(!$stmt) {
						echo "An error occurred in parsing the sql string.\n";
						exit;
					}
					OCIExecute($stmt);
					echo "<table border='1' width = '100%'>
								<tr class='cart_title'>
									<td width = '15%'>ID</td>
									<td>Title</td>
									<td width = '20%'>Author</td>
									<td width = '10%'>Price</td>
									<td width = '15%'>Stock</td>
									<td width = '15%'>Action</td>
								</tr>";
					while (OCIFetch($stmt)){
						$mess="";
						$title = OCIResult($stmt,"TITLE");
						$id = OCIResult($stmt,"BOOKID");
						$author = OCIResult($stmt,"AUTHOR");
						$price = OCIResult($stmt,"PRICE");
						$stock = OCIResult($stmt,"QUANTITY");
						
						
								echo "<tr>
									<td>" . $id . "</td>
									<td>" . $title . "</td>
									<td>" . $author . "</td>
									<td>" . $price . "</td>
									<td>" . $stock . "</td>
									
									<td><a href='editbook.php?bookid=". $id ."'>Edit</a> <a href='deletebook.php?bookid=". $id ."'> Delete </a></td>
								</tr>";
							
						
						
					}
					echo "</table>";
					echo $mess;
                }
            ?>
				
				
				
                
				<div class="cleaner">&nbsp;</div>
            </div>
			
        </div> <!-- end of content right -->
    
    	<div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->
    
    <?php include("inc/footer.php") ?>  
    <!-- end of footer -->

</div> <!-- end of container -->
</body>
</html>