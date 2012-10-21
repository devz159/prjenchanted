<div class="toolbar">
    <div class="titlebar">
      <h1>Edit Country</h1>                      
    </div><div class="actionbutton"><a href="<?php echo base_url("admin/panel/section/countries"); ?>">Cancel Edit Country</a></div><div class="clearthis"></div>
    
    <?php echo form_open("./admin/panel/validateeditcountry"); ?>
    	<?php if($countries): ?>
        	<?php foreach($countries as $country): ?>
            <input type="hidden" name="country_id" value="<?php echo $country_id; ?>" />
    	<p><label>Code</label><input type="text" name="code" value="<?php echo $country->code; ?>" /><?php echo display_error('code'); ?></p>
        <p><label>Country</label><input type="text" name="country" value="<?php echo $country->name; ?>"/><?php echo display_error('country'); ?></p>
        <p><input class="submitbtn" type="submit" value="Save" /></p>
        	<?php endforeach; ?>
        <?php endif; ?>
    <?php echo form_close(); ?>
</div>