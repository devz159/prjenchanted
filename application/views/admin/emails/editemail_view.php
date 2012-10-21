<?php if(! $superadmin): ?>
	<div class="toolbar">
                	<div class="titlebar">
                	  <h1>Edit Emails</h1></div>
                    	
                    <div class="extrabar"></div>
                    <div class="runninglist">
                    	<p class="error">ACCESS DENIED! Sorry you don't have enough privilege. <?php echo anchor(base_url("admin/panel"), 'Go back to default page'); ?>.</p>
                   	</div>
                </div>
           <?php exit(); ?>     
<?php endif; ?>
<div class="toolbar">
                	<div class="titlebar">
                	  <h1>Edit Email</h1>
                      </div>
                      <div class="actionbutton"><a href="<?php echo base_url("admin/panel/section/emails"); ?>">Cancel Edit Email</a></div>
                      <div class="clearthis"></div>
    <?php echo form_open("admin/panel/validateeditemail"); ?>
    		<input type="hidden" name="email_id" value="<?php echo $email_id; ?>" />
            <?php if($emails): ?>
            <?php foreach($emails as $email): ?>
            <p><label>Email</label> <input type="text" name="email" value="<?php echo $email->email; ?>" /><?php echo display_error('email'); ?></p>
            <p><label>Description</label>
            	<input type="text" name="description" value="<?php echo $email->description; ?>" />
            </p>
            
           
        <!--<fieldset>
        	<legend></legend><label>Active <input type="checkbox" name="active" <?php echo set_checkbox('active', '1'); ?> value="1" /></label></fieldset>-->
        <p><input class="submitbtn" type="submit" value="Save" /></p>
    <?php echo form_close(); ?>
    <?php endforeach; ?>
    <?php endif; ?>
</div>