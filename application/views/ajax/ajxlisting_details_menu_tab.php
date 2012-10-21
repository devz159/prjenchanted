<!-- overview -->
<?php if($tab == 8): ?>
	  <?php foreach($listing as $list): ?>
        <div class="editorpane">
                <?php echo $list->description; ?>
            </div>            
		<div class="editorsideinfo">
                <h4>Location</h4>
                <p>
                    <?php echo $list->address; ?><br />
                    <?php echo "$list->suburb, $list->state, $list->postcode"; ?><br />
                    <?php echo $list->country; ?>
                </p>
                
                <h4>Contact</h4>
                <p>Suncoast Enclosures </p>
                
                <ul>
                    <li><a lst_id="<?php echo $list->lst_id; ?>" anlytcvalue="<?php echo "$list->phone"; ?>" class="sprite viewphone" href="#">View phone number</a></li>
                    <li><a class="sprite sendemail" href="#">Send email</a></li>
                    <li><a lst_id="<?php echo $list->lst_id; ?>" anlytctype="url" target="_blank" class="sprite viewsite" href="<?php echo "http://$list->url"; ?>">View website</a></li>
                </ul>
            </div>
      <?php endforeach; ?>  
<!-- photos -->
<?php elseif($tab == 4): ?>
<div class="wordpanecontent">
   	<div class="photosviewbox">
<h3>test</h3>
	    	<div class="imageviewer">
           	  <img src="<?php echo base_url(). "ads/1/wPf5UApZWyf528764d624db129b32c21fbca0cb8d6.jpg"; ?>" />
</div>
            
            <div class="thumbnails">
            
            </div>
        </div>
    </div>
<!-- map -->
<?php elseif($tab == 2): ?>
<div class="wordpanecontent">
	<div id="hugemap">
    
    </div>
</div>

<!-- online enquiry -->
<?php elseif($tab == 1): ?>

	<div class="wordpanecontent">
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
<?php endif; ?>