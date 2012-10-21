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
    	<div class="teaser">
        	<p>Make your business visible on the internet and this is the right place to list it online.</p>
        </div>
                
        <div class="loginmenucontainer">
        	<div class="popuplogin">
	<div class="sprite calloutpointer"></div>
	<?php echo form_open(base_url()); ?>
    	
        <p><label>Username</label> <input class="required" type="text" name="uname" /></p>
        <p><label>Password</label> <input class="required" type="password" name="pword" /></p>
        <p><a href="#" onClick="return false;">Forgot password?</a> &nbsp; <input class="popuploginbtn" type="submit" value="Login" /></p>
        
    <?php echo form_close(); ?>
</div>
        	<ul id="loginmenu">
				<?php if($user != ''): ?>
                	<li class="firstchild"><a href=""><span class="yellow">Not</span> <?php echo $user; ?>?</a>
                    	<ul>
                        	<li><a href="<?php echo base_url() . 'advertiser/my'; ?>">Goto My Account</a></li>
                            <li><a href="<?php echo base_url() . 'advertiser/my/section/active_list'; ?>">My Active Listing</a></li>
                            <li><a href="<?php echo base_url() . 'directory/search/my_signout'; ?>">Sign-out</a></li>
                        </ul>
                    </li>
                    
                <?php else: ?>
                	<li class="firstchild"><a id="signinlnk" href="<?php echo base_url(); ?>login">Sign-in</a></li>
                <?php endif; ?>
            	<?php if($user == ''): ?>
                <li class="lastchild"><a href="<?php echo base_url() . 'directory/register'; ?>">Register</a></li>
                <?php endif; ?>
            </ul>
        </div><div class="clearthis"></div>
    </div>
</div>

<div class="middle">
	
    
</div>

<div class="middle">
<div id="comlogo">
        	<img src="<?php echo base_url(); ?>images/companylogo.png" />
        </div>
<div class="calltoaction">
            <div><a class="sprite ctabox" href="<?php echo base_url(); ?>directory/listing"><span class="sprite"></span>List your business</a></div>
        </div><div class="clearthis"></div>

<div id="left">
        
        
        <?php if(viewSearchBar()): ?>
            <div class="sprite module searchbar">
                <div>
                    <h2><span class="sprite"></span>Search</h2>
                    <?php echo form_open(base_url() . "directory/search"); ?>
                        <p><input type="text" name="searchquery" value="business title, description, location" /></p><p><button class="submitsearchbtn" type="submit" >Search</button></p>
                        <p class="advancesearch"><a href="#">advance search +</a></p>
                    <?php echo form_close(); ?>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="sprite module categories">
        	<div ctrltag="1" class="sprite controlbox <?php echo (1 == (1 & $sbsettings)) ? '' : 'controlboxcollapsed'; ?>"></div>
        	<h2><span class="sprite"></span>Categories</h2>
            <ul <?php echo (1 == (1 & $sbsettings)) ? '' : 'class="ulcontrolboxcollapsed"'; ?>>
            	<?php if(isset($maincategories)): ?>
                	<?php foreach($maincategories as $mcateg): ?>
						<li>
                        	<a href="<?php echo base_url(); ?>directory/search/search_categories/<?php echo $mcateg->mcat_id . '/' . url_title($mcateg->maincategory, 'underscore', TRUE);?>">
                            	<?php echo $mcateg->maincategory; ?> <em>(<?php echo $mcateg->count; ?>)</em>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
            	<li><a href="#">Acccommodation & Travel <em>(130)</em></a></li>
				<li><a href="#">Adult <em>(30)</em></a></li>
				<li><a href="#">Art, Drama, & Music <em>(110)</em></a></li>
				<li><a href="#">Automotive & Marine <em>(170)</em></a></li>
				<li><a href="#">Beauty <em>(130)</em></a></li>
				<li><a href="#">Building & Construction <em>(14)</em></a></li>
				<li><a href="#">Business & Professional (<em>114)</em></a></li>
				<li><a href="#">Coumputer & Internet Services <em>(145)</em></a></li>
				<li><a href="#">Education & Tuition <em>(1)</em></a></li>
				<li><a href="#">Finance <em>(130)</em></a></li>
				<li><a href="#">Food & Dining <em>(13)</em></a></li>
                <?php endif; ?>
            </ul>
        </div>
        
        <div class="sprite module locations">
        	<div ctrltag="2" class="sprite controlbox <?php echo (2 == (2 & $sbsettings)) ? '' : 'controlboxcollapsed'; ?>"></div>
        	<h2><span class="sprite"></span>Locations</h2>
            
            <ul <?php echo (2 == (2 & $sbsettings)) ? '' : 'class="ulcontrolboxcollapsed"'; ?>>
            	<?php if(isset($locations)): ?>
                	<?php foreach($locations as $loc): ?>
                		<li>
                        	<a href="<?php echo base_url() . 'directory/search/search_location/' . $loc->s_id . '/' . url_title($loc->name, 'underscore', TRUE); ?>"><?php echo $loc->code; ?> <em>(<?php echo $loc->count; ?>)</em></a>                        </li>                    
                    <?php endforeach; ?>
                <?php else: ?>                
                    <li><a href="#">NSW <em>(5)</em></a></li>
                    <li><a href="#">QLD <em>(2560)</em></a></li>
                    <li><a href="#">VIC <em>(3)</em></a></li> 
                <?php endif; ?>
            </ul>
        </div>
        
        <div class="sprite module additional">
        	<div ctrltag="4" class="sprite controlbox <?php echo (4 == (4 & $sbsettings)) ? '' : 'controlboxcollapsed'; ?>"></div>
        	<h2><span class="sprite"></span>Additional</h2>
            <ul <?php echo (4 == (4 & $sbsettings)) ? '' : 'class="ulcontrolboxcollapsed"'; ?>>
            	<li><a href="#">No recents searches</a></li>
            </ul>
        </div>
        
        <div class="sprite module favorites">
        	<div ctrltag="8" class="sprite controlbox <?php echo (8 == (8 & $sbsettings)) ? '' : 'controlboxcollapsed'; ?>"></div>
        	<h2><span class="sprite"></span>Favorites</h2>
            
            <ul <?php echo (8 == (8 & $sbsettings)) ? '' : 'class="ulcontrolboxcollapsed"'; ?>>
            <?php if(isset($favorites)): ?>
		<?php foreach($favorites as $fav): ?>
            
            <li><a href="<?php echo base_url() . 'directory/listing/details/overview/' . $fav->lst_id; ?>"><span></span><?php echo strTruncate($fav->title, 30); ?></a> <a lst_id="<?php echo $fav->lst_id; ?>" class="removefavsb" href="#">»remove</a></li>
        
        <?php endforeach; ?>
    <?php else: ?>
    	<li><p><strong>No items found in your favorite list.</strong></p></li>
    <?php endif; ?>
    
            	
            </ul>
            
        </div>
        <p>&nbsp;</p>
    </div>
       
	
    <div class="menucontainer">
        	<ul id="menu">
            	<li><a class="selected" href="#">Home</a></li>
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
    
    
    <div id="container">
    	
        <div class="pane">
        	<div class="sprite menuselector"></div>
        	<div class="topproundcorner"></div>
            
            <div class="innercontent"><!-- innercontent --> 
            	<?php $this->load->view($main_content); ?>
               
			</div><!-- innercontent -->            
            <div class="bottomroundcorner"></div>
        </div> 
        <p>&nbsp;</p>
        <p>&nbsp;</p>
    </div>    
</div>

<div class="clearthis"></div>
<?php getFooter(); ?>
<div class="tooltipbox hide"></div>
</body>
</html>