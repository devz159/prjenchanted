<div class="toolbar">
    <div class="titlebar">
      <h1>Add New Country</h1>
                 
    </div><div class="actionbutton"><a href="<?php echo base_url("admin/panel/section/countries"); ?>">Cancel New Country</a></div><div class="clearthis"></div>
    
    <?php echo form_open("./admin/panel/validatenewcountry"); ?>
    	<p><label>Code</label><input type="text" name="code" /><?php echo display_error('code'); ?></p>
        <p><label>Country</label><input type="text" name="country" /><?php echo display_error('country'); ?></p>
        <p><input class="submitbtn" type="submit" value="Save" /></p>
    <?php echo form_close(); ?>
    </div>