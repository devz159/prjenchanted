<?php if(! $superadmin): ?>
	<div class="toolbar">
                	<div class="titlebar">
                	  <h1>Add New Emails</h1></div>
                    	
                    <div class="extrabar"></div>
                    <div class="runninglist">
                    	<p class="error">ACCESS DENIED! Sorry you don't have enough privilege. <?php echo anchor(base_url("admin/panel"), 'Go back to default page'); ?>.</p>
                   	</div>
                </div>
           <?php exit(); ?>     
<?php endif; ?>

<div class="toolbar">
                	<div class="titlebar">
                	  <h1>Add New Email</h1>
                      </div>
                      <div class="actionbutton"><a href="<?php echo base_url("admin/panel/section/emails"); ?>">Cancel New Email</a></div>
                      <div class="clearthis"></div>
    <?php echo form_open("admin/panel/validatenewemail"); ?>
            <p><label>Email</label> <input type="text" name="email" value="<?php echo set_value('email'); ?>" /><?php echo display_error('email'); ?></p>
            <p><label>Description</label>
            	<input name="description" type="text" /><?php echo display_error('description'); ?>
            </p>
            
        <!--<fieldset>
        	<legend></legend><label>Active <input type="checkbox" name="active" <?php echo set_checkbox('active', '1'); ?> value="1" /></label></fieldset>-->
        <p><input class="submitbtn" type="submit" value="Save" /></p>
    <?php echo form_close(); ?>
</div>