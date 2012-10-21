<div>
	
    <ul>
    	<li><a href="#">Overview</a></li>
        <li><a href="#">Photos</a></li>
        <li><a href="#">Map</a></li>
        <li><a href="#">Online Enquiry</a></li>
    </ul>
</div>

<div>
	<?php foreach($listing as $ad): ?>
        <div>
			<h1><?php echo $ad->title; ?></h1>      
        </div>
		<div class="description">
        	<?php echo $ad->description; ?>
        </div>
        <div class="packagetype">
        	<?php if($ad->package ==1): ?>
				<p>Package: Premium</p>
            <?php else: ?>
            	<p>Package: Standard</p>
            <?php endif; ?>
        </div>
        
        <div class="sideinfo">
        	<div>
            	<h2>Location</h2>
            	<p>
                	<?php echo $ad->address; ?><br />
                    <?php echo $ad->suburb . ', ' . $ad->state_code . ' ' . $ad->postcode; ?><br />
                    <?php echo $ad->country; ?>
                </p>
                
                <h2>Contact</h2>
                <h3><?php echo $ad->cname; ?></h3>
                <ul>
                	<li><a id="showphone" lst_id="<?php echo $ad->lst_id; ?>" tag="<?php echo $ad->phone; ?>" href="#">Show phone number</a></li>
                    <li><a id="sendemail" lst_id="<?php echo $ad->lst_id; ?>" tag="<?php echo $ad->email; ?>" href="#">Send email</a></li>
                    <li><a id="viewwebsite" lst_id="<?php echo $ad->lst_id; ?>" tag="<?php echo appendWebProtocol($ad->url); ?>" href="#">View Website</a></li>
                </ul>
            </div>

        
        </div>
        
        <div class="onlineequiry">
        	<?php echo form_open(); ?>
            	
                <h2>Send Online Enquiry</h2>
                <p><label>Name</label> <input type="text" name="name" /></p>
                <p><label>Email</label> <input type="text" name="email" /></p>
                <p><label>Phone</label> <input type="text" name="phone" /></p>
                <p><label>Enquiry</label><textarea name="enquiry"></textarea></p>
                <p><input type="submit" value="Send Enquiry" /></p>
            
            <?php echo form_close(); ?>
        </div>
        
        <div class="listedincategories">
        	<h2>Belonged in categories</h2>
            <?php 				
				
				foreach($subcategories as $scateg): ?>
					<?php
						// preps some data
						$tmplink = preg_split("/=>/", $scateg);
						
						$flink = preg_split("/:/", $tmplink[0]);
						$slink = preg_split("/:/", $tmplink[1]);						
					?>
                	<li><a href="<?php echo trim($flink[1]); ?>"><?php echo trim($flink[0]); ?></a> => <a href="<?php echo trim($slink[1]); ?>"><?php echo trim($slink[0]); ?></a></li>                	
                <?php endforeach; ?>
					
				
            <ul>
            	<!-- lists all categories which it's belonged  -->
            </ul>
        </div>
        <p>Created: <?php echo $ad->created; ?></p>
        <p>Last Edited: <?php echo $ad->ledited; ?></p>
	<?php endforeach; ?>
</div>