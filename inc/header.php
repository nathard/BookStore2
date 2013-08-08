
<!-- Begin Header -->
<div id="templatemo_container">
	<div id="templatemo_menu">
    	<ul>
            
			<li class="selected"><a href="index.php">Home</a></li>
			<li><a href="about.php">About Us</a></li>
            <li><a href="books.php">Books</a></li>
			<li><a href="newrelease.php">New Releases</a></li>
			<li><a href="register.php">Register</a></li>
			<!--check username already exists to show suitable menu-->
			<?php echo'<li><a href="';
				if(empty($username)) 
					echo "myaccount.php"; 
				else 
					echo"userProfiles.php";
					echo'">My Account</a></li>'; 
			?>            
            
            <li><a href="contact.php">Contact Us</a></li>
            <?php 
			if(!empty($username)) {
				echo '<li><a href="userProfiles.php" class="helloUser">Hello "'.$username.' "</a></li>';			
				echo '<li><a href="logout.php" class="helloUser">Logout</a></li>';
			}else{
				echo '<li><a href="myaccount.php" class="helloUser">Login</a></li>';
			}
		?>	
					
    	</ul>
    </div> <!-- end of menu -->
    
    <div id="templatemo_header">
	<!--hello user-->
	
		
			
		<div id="templatemo_special_offers">
		<p>
		<br />
		<span>10%</span> discounts for these books:		
		</p>
	
			<ul>
			
					<li><a href="details.php?action=show&amp;id=1"><script type="text/javascript">displayTitle(0);</script></a></li>
                    <li><a href="details.php?action=show&amp;id=11"><script type="text/javascript">displayTitle(10);</script></a></li>                    
            </ul>
		
		
		</div>
		
				<div id="templatemo_new_books">
                    <ul>
					<li><a href="details.php?action=show&amp;id=9"><script type="text/javascript">displayTitle(8);</script></a></li>
                    <li><a href="details.php?action=show&amp;id=2"><script type="text/javascript">displayTitle(1);</script></a></li>                    
					</ul>
				</div>
    </div>
    
   