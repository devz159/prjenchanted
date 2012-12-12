<?php if(isset($listing)): ?>

	<?php foreach($listing as $list): ?>
<div class="masterheader">
    <div class="businesstitle"><?php echo strTruncate($list->title,45); ?></div>
    <div class="listingpackage"><span class="sprite"></span><?php echo ($list->package) ? 'Premium' : 'Standard'; ?></div>
    <div class="clearthis"></div>
    
    <?php if($list->package == '1'): // Premium package ?>
    	<div class="logoandgoogleads" style="position:relative;">
  		
			<?php if(getThumbImg($list->images) != ""): ?> 
                  <img <?php  echo imagePosition(base_url() . "ads/$list->advr/" . getThumbImg($list->images)); ?> src="<?php echo base_url() . "ads/$list->advr/" . getThumbImg($list->images); ?>" />
            <?php else: ?>
                <img src="<?php echo base_url() . "images/no_image_icon_big.jpg";  ?>" />
            <?php endif; ?></div>
        <?php else: // Standard package ?>
        	<div class="logoandgoogleads googleadsonly" style="position:relative;">
            	<!--<ul>
                	<li>
                    	<p><a href="#"><strong>Vacancies Melbourne</strong></a></strong></p>
                   	 	<p>5 urgent positions left. Apply now! Vacancies Melbourne</p>
                    	<p><a class="smaller" href="#">jobrapido.com/vacancies+melbourne</a></p>
					</li>
                    <li>
						<p><a href="#"><strong>Tour Brisbane</strong></a></p>
						<p>Find and book 30+ things to do in Brisbane on Viator.</p>
						<p><a class="smaller"  href="#">www.viator.com/brisbane</a></p>
					</li>
                    <li>
						<p><a href="#"><strong>Agoda - Hotels worldwide</strong></a></p>
						<p>Last minute offers (even same day!) lowest rates, check availability</p>
						<p><a class="smaller"  href="#">Agoda.com/Hotels</a></p>
					</li>
					<!--<li>
						<p><a href="#"><strong>Architectural signage</strong></a><br />
						Materials with optimum durability Products and wayfinding solutions<br />
						<a href="#">www.marcal.fr</a></p>
					</li>
				</ul>-->
                <?php echo $this->googleadsense->createAdSense(2); ?>
                
        	</div>
        <?php endif; ?>
    
    
    
    <div id="mnmap" class="minimap"></div>

</div>
<div class="clearthis"></div>
<div class="masterdetails">
		<ul class="mapbutton">
        	<li><a class="sprite" href="#">Enlarge Map</a></li>
        </ul>
    <div class="menutabs">
    	<?php
			$sectrSwitch='';
			
			switch($tab) {
				case 'overview':
					$sectrSwitch = '';
					break;
					
				case 'photos':
					$sectrSwitch = 'photos';					
					break;
					
				case 'map':
					$sectrSwitch = 'map';
					break;
				
				case 'enquiry':
					$sectrSwitch = 'enquiry';
					break;
				
				default:
					$sectrSwitch = '';
			}
		?>
        <div class="sprite submenuselector <?php echo $sectrSwitch; ?>"></div>
        <ul>
            <li><a lst_id="<?php echo $list->lst_id; ?>" ctrltag="8" <?php echo ('overview' == $tab) ? 'class="selected"' : ''; ?> href="<?php echo base_url(); ?>directory/listing/details/overview/<?php echo $list->lst_id; ?>">Overview</a></li>
            <li><a lst_id="<?php echo $list->lst_id; ?>" ctrltag="4" <?php echo ('photos' == $tab) ? 'class="selected"' : ''; ?> href="<?php echo base_url(); ?>directory/listing/details/photos/<?php echo $list->lst_id; ?>">Photos</a></li>
            <li><a lst_id="<?php echo $list->lst_id; ?>" ctrltag="2" <?php echo ('map' == $tab) ? 'class="selected"' : ''; ?> href="<?php echo base_url(); ?>directory/listing/details/map/<?php echo $list->lst_id; ?>">Map</a></li>
            <li><a lst_id="<?php echo $list->lst_id; ?>" ctrltag="1" <?php echo ('enquiry' == $tab) ? 'class="selected"' : ''; ?>href="<?php echo base_url(); ?>directory/listing/details/enquiry/<?php echo $list->lst_id; ?>">Online Enquiry</a></li>
        </ul>
        <div class="clearthis"></div>
    </div>
   <!-- tabs start here-->
   		<div class="wordpane">
        	
        	<div class="overviewbox">
            	<?php if($list->package == '1'): ?>
                    <div class="editorpane">
                    <?php echo $list->description; ?>
                    </div>            
                    <div class="editorsideinfo">
                        <h4>Location </h4>
                        <p>
                            <?php echo $list->address; ?><br />
                            <?php echo "$list->suburb, $list->state, $list->postcode"; ?><br />
                            <?php echo $list->country; ?>
                        </p>
                        
                        <h4>Contact</h4>                                           
                        <ul>
                            <li><a lst_id="<?php echo $list->lst_id; ?>" anlytcvalue="<?php echo "$list->phone"; ?>" class="sprite viewphone" href="#">View phone number</a></li>
                            <li><a lst_id="<?php echo $list->lst_id; ?>" class="sprite sendemail" href="#">Send email</a></li>
                            <li><a lst_id="<?php echo $list->lst_id; ?>" anlytctype="url" target="_blank" class="sprite viewsite" href="<?php echo "http://$list->url"; ?>">View website</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                	<div class="minieditorpane">
                    	 <?php echo $list->description; ?>
                    </div>
                    
                    <div class="sponsoredlisting googleadsonly">
                    	<h3>Sponsored Listing</h3>
                      <!--  <ul>
                        	<li>
                            	<p><a href="#"><strong>Jobs Australia</strong></a></p>
                                <p>5 urgent open positions. Apply now! Jobs Australia</p>
                                <p><a class="smaller" href="#">jobrapido.com/jobs+australia</a></p>
							</li>
							<li>
                            	<p><a href="#"><strong>Tour Brisbane</strong></a></p>
                                <p>Find and book 30+ things to do in Brisbane on Viator.</p>
                                <p><a class="smaller">www.viator.com/brisbane</a></p>
							</li>
							<li>
                            	<p><a href="#"><strong>Architectural signage</strong></a></p>
                                <p>Materials with optimum durability Products and wayfinding solutions</p>
                                <p><a class="smaller" href="#">www.marcal.fr</a></p>
                            </li>
                        </ul>-->
                        <?php echo $this->googleadsense->createAdSense(3,0); ?>
                    </div>
                    
                    <div class="minieditorsideinfo">
                    	<h4>Location </h4>
                        <p>
                            <?php echo $list->address; ?><br />
                            <?php echo "$list->suburb, $list->state, $list->postcode"; ?><br />
                            <?php echo $list->country; ?>
                        </p>
                        
                        <h4>Contact</h4>                                           
                        <ul>
                            <li><a lst_id="<?php echo $list->lst_id; ?>" anlytcvalue="<?php echo "$list->phone"; ?>" class="sprite viewphone" href="#">View phone number</a></li>
                            <li><a lst_id="<?php echo $list->lst_id; ?>" class="sprite sendemail" href="#">Send email</a></li>
                            <li><a lst_id="<?php echo $list->lst_id; ?>" anlytctype="url" target="_blank" class="sprite viewsite" href="<?php echo "http://$list->url"; ?>">View website</a></li>
                        </ul>
                    </div>
                	                    
                <?php endif; ?>
            </div>
            
            <div class="photosbox hidden">
            	<div class="photosviewbox">
	
	    	<div class="imageviewer">
            	<?php if(getThumbImg($list->images) != ""): ?>  				 
	            	<img src="<?php echo base_url(). "ads/$list->advr/" . getThumbImg($list->images); ?>" />
                <?php else: ?>
                	<img src="<?php echo base_url(). "images/no_image_icon_big.jpg"; ?>" />
                <?php endif; ?>
            </div>
            
            <div class="thumbnails">
          		 <?php 
			
					// gets the thumbnails
					$images = preg_split('/,/', $list->images);
				?>
			
            	<?php if(!empty($images)): ?>
					<?php foreach($images as $img): ?>
                        <div>
                        <img advrpath="<?php echo $list->advr; ?>" imgfile="<?php echo $img; ?>" src="<?php echo base_url(). "ads/$list->advr/thumbs/$img"; ?>" />
                    </div>
					<?php endforeach; ?>
                <?php else: ?>
                	 <div>
                        <img advrpath="<?php echo $list->advr; ?>" imgfile="<?php echo $img; ?>" src="<?php echo base_url(). "images/no_image_icon.jpg"; ?>" />
                    </div>
				<?php endif; ?>                                      
            </div>
        </div>
        <div class="clearthis"></div>
            </div>
                        
            <div class="mapbox">
            	<div id="hugemap"></div>
            </div>
            
            <div class="enquirybox hidden">
            	<?php echo form_open(); ?>
        	<h2>Send Online Enquiry</h2>
            <p><span>* denotes required</span></p>
        	<p><label>Name*</label> <input class="required" type="text" name="name" /></p>
            <p><label>Email*</label> <input class="required email" type="text" name="email" /></p>
            <p><label>Phone</label> <input type="text" name="phone" /></p>
            <p><label>Enquiry*</label> <textarea class="required" name="enquiry"></textarea></p>
            <p><input class="submitbtn" type="submit" value="Send Inquiry" /></p>
        <?php echo form_close(); ?>
            </div>
        </div>
   <!-- tabs end here-->
</div>
	<?php endforeach; ?>
<?php else: ?>


<?php endif; ?>