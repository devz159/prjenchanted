<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="url" content="<?php echo base_url();?>" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico" />

<?php getHeader(); ?>
</head>

<body>

<div id="header">
	<div class="middle">
    	<div id="comlogo">
        	<img src="<?php echo base_url(); ?>images/companylogo.png" />
        </div>
        
        <div class="menucontainer">
        	<ul id="menu">
            	<li><a class="selected" onClick="test();" href="#">Home</a></li>
                <li><a href="#">Destinations</a></li>
                <li><a href="#">Things to Do</a>
                	<ul>
                    	<li><a href="#">Things to do one</a></li>
                        <li><a href="#">Things to do two</a></li>
                        <li><a href="#">Things to do three</a></li>
                        <li><a href="#">Things to do four</a></li>
                        <li><a href="#">Things to do five</a></li>
                        <li><a href="#">Things to do six</a></li>
                    </ul>
                </li>
                <li><a href="#">Tourist Information</a>
                	<ul>
                    	<li><a href="#">Tourist Info One</a></li>
                        <li><a href="#">Tourist Info Two</a></li>
                        <li><a href="#">Tourist Info Three</a></li>
                        
                    </ul>
                </li>
                <li><a href="#">Directory</a></li>
            </ul>
        </div>        
        <div class="loginmenucontainer">
        	<ul id="loginmenu">
            	<li class="firstchild"><a href="#">Sign-in</a></li>
                <li class="lastchild"><a href="#">Register</a></li>
            </ul>
        </div><div class="clearthis"></div>
    </div>
</div>

<div class="middle">
	<div class="calltoaction">
    	<div><a class="sprite ctabox" href="#"><span class="sprite"></span>List your business</a></div>
    </div>
    
    <div class="bannerwindow">
    	<img src="<?php echo base_url(); ?>images/window_banner.png" width="1019" height="437" />
    </div>
</div>

<div class="middle">
	<div id="left">
    	<div class="module search">
        	<h2>Search</h2>
            <form action="<?php echo base_url(); ?>directory/search" method="post" >
            	<p><input type="text" name="searchkey" /> <button class="searchbtnone" name="search" type="submit" >Search</button></p>

                <p><a class="advancesearch" href="#">advace search +</a>
          </form> 
        </div>
        
        <div class="module directorylisting">
        	<h2>Directory Listing</h2>
            
            <div class="directorybox">
            	<div class="directoryitembox"><a href="#"><img src="<?php echo base_url(); ?>images/pic_thumb_img9.png" /></a></div>
                <div class="directoryitembox"><a href="#"><img src="<?php echo base_url(); ?>images/pic_thumb_img10.png" /></a></div>
                <div class="directoryitembox"><a href="#"><img src="<?php echo base_url(); ?>images/pic_thumb_img11.png" /></a></div>
                <div class="directoryitembox"><a href="#"><img src="<?php echo base_url(); ?>images/pic_thumb_img12.png" /></a></div>
                <div class="directoryitembox"><a href="#"><img src="<?php echo base_url(); ?>images/pic_thumb_img13.png" /></a></div>
                <div class="directoryitembox"><a href="#"><img src="<?php echo base_url(); ?>images/pic_thumb_img14.png" /></a></div>
            </div>
            <div class="clearthis"></div>
        </div>
        
        <div class="module carrentals">
        	<h2>Car Rentals</h2>
            
            <div class="carrentalsbox">
            	<a href="#"><img src="<?php echo base_url(); ?>images/car_rental_banner.png" /></a>
            </div>
            
        </div>
        
        <div class="module houserentals">
        	<h2>House Rentals</h2>
            
            <div class="houserentalsbox">
            	<a href="#"><img src="<?php echo base_url(); ?>images/house_rental_banner.png" /></a>
            </div>
            
        </div>
        
    </div>
    
    <div id="container">    
    	<?php $this->load->view($main_content); ?>
    </div>    
</div>

<div class="clearthis"></div>

<?php getFooter(); ?>

</body>
</html>