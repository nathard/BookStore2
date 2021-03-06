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
        	
		<h1>Message</h1>
		
		<?php
			
			//Update book information
			$action = $_GET['action'];
			$title = $_POST['title'];
			$bookid = $_POST['bookid'];
			$category = $_POST['category'];
			$author = $_POST['author'];
			$price = $_POST['price'];
			$stock = $_POST['stock'];
			$isbn1 = $_POST['isbn1'];
			$isbn2 = $_POST['isbn2'];
			$year = $_POST['year'];
			$image = $_FILES['file']['name'];
						
			if ($action == 1) //Update
			{
				/* build sql statement using form data */
               
                $query = "update books set TITLE = '". $title ."', AUTHOR = '". $author ."', ISBN1 = '". $isbn1 ."'";
                $query .= ", ISBN2 = '". $isbn2 ."', YEAR = ". $year .", PRICE =". $price .", CATEGORYID = ". $category .", QUANTITY = ". $stock .", IMAGE = '". $image ."'";
				$query .= " where BOOKID = " . $bookid ;
				/* check the sql statement for errors and if errors report them */
				$stmt = OCIParse($connect, $query);
				//echo $query;
				if(!$stmt) {
					echo "An error occurred in parsing the sql string.\n";
					exit;
				}
				if (OCIExecute($stmt))
                {
                    $ok = 1;
                }
                else
                {
                    $ok = 0;
                }
			}
			elseif ($action == 2) //Insert
			{
				//get max book id
				$newbookid = 0;
				$query = "select max(BOOKID) from books";
				$stmt = OCIParse($connect, $query); 
				if(!$stmt) {
					echo "An error occurred in parsing the sql string.\n";
					exit;
				}
				
				OCIExecute($stmt);
				while(OCIFetch($stmt)) {
					$newbookid = OCIResult($stmt,1);
				}
				
				$newbookid++;
						
				/* build sql statement using form data */
				
                $query = "Insert into books(BOOKID, TITLE, AUTHOR, ISBN1, ISBN2, YEAR, PRICE, IMAGE, QUANTITY, CATEGORYID, PUBLISHER) ";
				$query .= " values (". $newbookid .", '". $title ."','". $author ."', '". $isbn1 ."', '". $isbn2 ."', ". $year .", ". $price .",'". $image ."', ". $stock .", ". $category .",'')"; 
				/* check the sql statement for errors and if errors report them */
				$stmt = OCIParse($connect, $query);
				
				if(!$stmt) {
					echo "An error occurred in parsing the sql string.\n";
					exit;
				}
				if (OCIExecute($stmt))
                {
                    $ok = 1;
                }
                else
                {
                    $ok = 0;
                }
			}
			
			if ($ok == 1)
			{
				if ($action == 1)
				{
					echo "<h2>Book information is updated.</h2><br/>";
				}
				else
				{
					echo "<h2>New book has been inserted.</h2><br/>";
				}
				//**********Upload file to server**********************
				$allowedExts = array("jpg", "jpeg", "gif", "png");
				$extension = end(explode(".", $_FILES["file"]["name"]));
				
				if ((($_FILES["file"]["type"] == "image/gif")
				|| ($_FILES["file"]["type"] == "image/jpeg")
				|| ($_FILES["file"]["type"] == "image/pjpeg")
				|| ($_FILES["file"]["type"] == "image/jpg"))
				&& ($_FILES["file"]["size"] < 20000)
				&& in_array($extension, $allowedExts))
				  {
				 
				  if ($_FILES["file"]["error"] > 0)
					{
					echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
					}
				  else
					{					
					if (file_exists("../images/" . $_FILES["file"]["name"]))
					  {
					  echo "But the image '". $_FILES["file"]["name"] . "' already exists. ";
					  }
					else
					  {
					  move_uploaded_file($_FILES["file"]["tmp_name"],
					  "../images/" . $_FILES["file"]["name"]);
					  echo "The image for this book is stored in: " . "images/" . $_FILES["file"]["name"];
					  }
					}				
				  }
				else
				  {				
					echo "But the image for this book is invalid";
				  }
				//**********************End of upload file****************************
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