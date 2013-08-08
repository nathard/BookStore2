<?xml version = "1.0"?>
<!-- Description: Assignment 2 -->
<!-- Author: LE VIET THANH PHONG -->
<!-- Modified Date: 20 Sept 2011 -->
<!-- Date: 30 Sept 2011 -->
<!-- Validated: OK 30 Aug 2011 -->
<xsl:stylesheet version = "1.0"
   xmlns:xsl = "http://www.w3.org/1999/XSL/Transform">
   
   <xsl:output method = "html" omit-xml-declaration = "no" 
      doctype-system = 
         "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" 
      doctype-public = "-//W3C//DTD XHTML 1.0 Strict//EN" />

   <xsl:template match = "/">
      <html xmlns = "http://www.w3.org/1999/xhtml">
         <head>
        <!--    <title><xsl:value-of select = "product/@name"/>
            </title>-->
			<title>Book Store</title>
			<link rel="stylesheet" type="text/css" href="style.css" />
			<script type="text/javascript" src="js/loadXMLnXSL.js"></script>
			<script src="js/prototype.js" type="text/javascript"></script>
			<script src="js/scriptaculous.js?load=effects" type="text/javascript"></script>
			<script type="text/javascript" src="js/java.js"></script>
			
		</head>
<body>
<div id="wrap">		 
<!--menu header-->
		 <div class="header">
       		<div class="logo"><a href="index.html"><img src="images/logo.gif" alt="" title="" border="0" /></a></div>            
        <div id="menu">
            <ul>                                                                       
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About Us</a></li>
            <li  class="selected"><a href="category.html">Books</a></li>
            <li><a href="specials.html">Specials Books</a></li>
            <li><a href="myaccount.html">My Account</a></li>
            <li><a href="register.html">Register</a></li>
            <li><a href="details.html">Prices</a></li>
            <li><a href="contact.html">Contact</a></li>
			
			<li> <input type="text" id= "search" size="25" />
			<input type="submit" value="Search" />			
			</li>
            </ul>
        </div>     		
            <a href="Search.html" class="advancedSearch">Advanced Search</a>
            
       </div><!--end of menu header--> 
	   <div class="center_content">
	   <!--left content-->
		<div class="left_content">
		 			
			<div class="crumb_nav">
            <a href="index.html">Home</a> &gt;&gt; Book List
            </div>
			<!--a loop to get all information in XML file-->
			<xsl:for-each select = "CATALOG/BOOK">
            <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /><xsl:value-of select = "TITLE"/></span>
						</div>
        
        	<div class="feat_prod_box_details">
            
            	
				<div class="prod_img">
					<a href="details.html">
					<xsl:element name ="img">
						        <!--<xsl:attribute name="style">width: 120px; height: 180px;</xsl:attribute>-->
						<xsl:attribute name="src">						
						<xsl:value-of select="IMAGE"/>
						</xsl:attribute>
						</xsl:element>			
				    </a>
				</div>
				<div class="prod_det_box">
                	<div class="box_top"></div>
                    <div class="box_center">
				                    
					<div class="price"><strong>TITLE:</strong> <span class="red"><xsl:value-of select = "TITLE"/></span></div>
					<div class="price"><strong>AUTHOR:</strong> <span class="red"><xsl:value-of select = "AUTHOR"/></span></div>
					<div class="price"><strong>PUBLISHER:</strong> <span class="red"><xsl:value-of select = "PUBLISHER"/></span></div>
					<div class="price"><strong>ISBN:</strong> <span class="red"><xsl:value-of select = "ISBN/ISBN1"/>&#44;&#160;<xsl:value-of select = "ISBN/ISBN2"/></span></div>
					<div class="price"><strong>YEAR:</strong> <span class="red"><xsl:value-of select = "YEAR"/></span></div>
                    <div class="price"><strong>PRICE:</strong> <span class="red"><xsl:value-of select = "PRICE"/></span></div>
                    <!--<div class="price"><strong>COLORS:</strong> 
                    <span class="colors"><img src="images/color1.gif" alt="" title="" border="0" /></span>
                    <span class="colors"><img src="images/color2.gif" alt="" title="" border="0" /></span>
                    <span class="colors"><img src="images/color3.gif" alt="" title="" border="0" /></span>                   </div>-->
                    <a href="details.html" class="more"><img src="images/order_now.gif" alt="" title="" border="0" /></a>
                    <div class="clear"></div>
					
				</div>
                 <div class="box_bottom"></div>
            </div>
			
			<div class="clear"></div></div>
			 </xsl:for-each><!--end of loop-->
        </div><!--end of left content-->
		<!--right content-->
			<div class="right_content">
        	<div class="languages_box">
            <span class="red">Languages:</span>
            <a href="#" class="selected"><img src="images/gb.gif" alt="" title="" border="0" /></a>
            <a href="#"><img src="images/fr.gif" alt="" title="" border="0" /></a>
            <a href="#"><img src="images/de.gif" alt="" title="" border="0" /></a>
            </div>
                <div class="currency">
                <span class="red">Currency: </span>
                <a href="#">GBP</a>
                <a href="#">EUR</a>
                <a href="#" class="selected">USD</a>
                </div>
                
                
              <div class="cart">
                  <div class="title"><span class="title_icon"><img src="images/cart.gif" alt="" title="" /></span>My cart</div>
                  <div class="home_cart_content">
                  3 x items | <span class="red">TOTAL: 165.75$</span>
                  </div>
                  <a href="cart.html" class="view_cart">view cart</a>
              
              </div>
                       
            	
        
        
             <div class="title"><span class="title_icon"><img src="images/bullet3.gif" alt="" title="" /></span>About Our Store</div> 
             <div class="about">
             <p>
             <img src="images/about.gif" alt="" title="" class="right" />
             Our book store is an online retailer of books published in the Europe and the USA. We have been delivering an outstanding service to our worldwide customers for over 2 years.
             </p>
             
             </div>
             
            <!--promotion content-->
             <div class="right_box">
             
             	<div class="title"><span class="title_icon"><img src="images/bullet4.gif" alt="" title="" /></span>Promotions</div> 
                    <div class="new_prod_box">
                        <a href="details.html"><!--<script type="text/javascript">displayTitle(0);</script>--><xsl:value-of select = "CATALOG/BOOK/TITLE[@id=0]"/></a>
                        <div class="new_prod_bg">
                        <span class="new_icon"><img src="images/promo_icon.gif" alt="" title="" /></span>
                        <a href="details.html"><img src="images/wf.jpg" alt="White Fang" title="White Fang" class="thumb" border="0" height="90" width="60" /></a>
                        </div>           
                    </div>
                    
                    <div class="new_prod_box">
                        <a href="details.html"><!--<script type="text/javascript">displayTitle(2);</script>--><xsl:value-of select = "CATALOG/BOOK/TITLE[@id=2]"/></a>
                        <div class="new_prod_bg">
                        <span class="new_icon"><img src="images/promo_icon.gif" alt="" title="" /></span>
                        <a href="details.html"><img src="images/finance.jpg" alt="Fundamentals of financial management" title="Fundamentals of financial management" class="thumb" border="0" height="90" width="60"/></a>
                        </div>           
                    </div>                    
                    
                    <div class="new_prod_box">
                        <a href="details.html"><!--<script type="text/javascript">displayTitle(10);</script>--><xsl:value-of select = "CATALOG/BOOK/TITLE[@id=10]"/></a>
                        <div class="new_prod_bg">
                        <span class="new_icon"><img src="images/promo_icon.gif" alt="" title="" /></span>
                        <a href="details.html"><img src="images/ccnp.jpg" alt="CCNP switching study guide" title="CCNP switching study guide" class="thumb" border="0" height="90" width="60"/></a>
                        </div>           
                    </div>                          
             
             </div><!--end of promotion content-->
             
             <div class="right_box">
             
             	<div class="title"><span class="title_icon"><img src="images/bullet5.gif" alt="" title="" /></span>Categories</div> 
                
                <ul class="list">
                <li><a href="#">accesories</a></li>
                <li><a href="#">books gifts</a></li>
                <li><a href="#">specials</a></li>
                <li><a href="#">hollidays gifts</a></li>
                <li><a href="#">accesories</a></li>
                <li><a href="#">books gifts</a></li>
                <li><a href="#">specials</a></li>
                <li><a href="#">hollidays gifts</a></li>
                <li><a href="#">accesories</a></li>
                <li><a href="#">books gifts</a></li>
                <li><a href="#">specials</a></li>                                              
                </ul>
                
             	<div class="title"><span class="title_icon"><img src="images/bullet6.gif" alt="" title="" /></span>Partners</div> 
                
                <ul class="list">
                <li><a href="#">accesories</a></li>
                <li><a href="#">books gifts</a></li>
                <li><a href="#">specials</a></li>
                <li><a href="#">hollidays gifts</a></li>
                <li><a href="#">accesories</a></li>
                <li><a href="#">books gifts</a></li>
                <li><a href="#">specials</a></li>
                <li><a href="#">hollidays gifts</a></li>
                <li><a href="#">accesories</a></li>                              
                </ul>      
             
             </div>         
             
        
        </div><!--end of right content-->
		
			<div class="clear"></div>
			</div><!--end of center content-->
      
              
       <div class="footer">
			<div class="left_footer"><img src="images/footer_logo.gif" alt="" title="" /><br /> <a href="http://csscreme.com/freecsstemplates/" title="free templates"><img src="images/csscreme.gif" alt="free templates" title="free templates" border="0" /></a></div>
			<div class="right_footer">
			<a href="index.html">home</a>
			<a href="about.html">about us</a>
			<a href="#">services</a>
			<a href="#">privacy policy</a>
			<a href="contact.html">contact us</a>		   
			</div>
		</div>
</div>

<p>&#169;Deakin University, School of Information Technology. This web page has been developed as a student assignment for the unit SIT203: Web Programming. Therefore it is not part of the University's authorised web site. DO NOT USE THE INFORMATION CONTAINED ON THIS WEB PAGE IN ANY WAY."</p>
		 </body>
      </html>
   </xsl:template>
</xsl:stylesheet>