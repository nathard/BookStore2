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
        	
		<h1><a href="index.php">Administration</a> --> <a href="books.php">Books</a> --> Remove book</h1>
		<?php
			$bookid = strtoupper($_GET['bookid']); 
			//Check if book have order
			$count = 0;
			
			$query = "select count(*) from orderSummary where BOOKID = " . $bookid;
			$stmt = OCIParse($connect, $query); 
			if(!$stmt) {
				echo "An error occurred in parsing the sql string.\n";
				exit;
			}
			
			OCIExecute($stmt);
			while(OCIFetch($stmt)) {
				$count = OCIResult($stmt,1);
			}
			
			//////////////////////////
			
			
			if ($count == 0)
			{
			
			
				
				// build sql statement using form data 
				
				$query = "delete books where BOOKID = " . $bookid;			
				// check the sql statement for errors and if errors report them 
				$stmt = OCIParse($connect, $query);
				//echo $query;
				
				if(!$stmt) {
					echo "An error occurred in parsing the sql string.\n";
					exit;
				}
				if (OCIExecute($stmt))
				{
					echo "This book has been removed from catelog";
				}
				else
				{
					echo "Can not remove this book";
				}
				
			}
			else
			{
				echo "This book have an order.";
			}
			
		?>
            
			
        </div> <!-- end of content right -->
    
    	<div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->
    
    <?php include("inc/footer.php") ?>  
    <!-- end of footer -->

</div> <!-- end of container -->
</body>
</html>