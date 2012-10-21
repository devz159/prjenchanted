<?php if(! $superadmin): ?>
	<div class="toolbar">
                	<div class="titlebar">
                	  <h1>Add New User</h1></div>
                    	
                    <div class="extrabar"></div>
                    <div class="runninglist">
                    	<p class="error">ACCESS DENIED! Sorry you don't have enough privilege. <?php echo anchor(base_url("admin/panel"), 'Go back to default page'); ?>.</p>
                   	</div>
                </div>
           <?php exit(); ?>     
<?php endif; ?>

<div class="toolbar">
                	<div class="titlebar">
                	  <h1>Add New User</h1>
                      </div>
                      <div class="actionbutton"><a href="<?php echo base_url("admin/panel/section/users"); ?>">Cancel New User</a></div>
                      <div class="clearthis"></div>
    <?php echo form_open("admin/panel/validatenewuser"); ?>
            <p><label>First Name</label> <input type="text" name="fname" value="<?php echo set_value('fname'); ?>" /><?php echo display_error('fname'); ?></p>
            <p><label>Last Name</label> <input type="text"  value="<?php echo set_value('lname'); ?>" name="lname" /><?php echo display_error('lname'); ?></p>
            <p><label>Username</label> <input type="text" value="<?php echo set_value('uname'); ?>" name="uname" /><?php echo display_error('uname'); ?></p>
            <p><label>Password</label> <input type="password" value="<?php echo set_value('pword'); ?>" name="pword" /><?php echo display_error('pword'); ?></p>
            <p><label>Confirm Password</label> <input type="password" value="<?php echo set_value('pword2'); ?>" name="pword2" /><?php echo display_error('pword2'); ?></p>
            <p>
              <label>Email</label> <input type="text" value="<?php echo set_value('email'); ?>" name="email" /><?php echo display_error('email'); ?></p>
            <p><label>Access Level</label> <input type="text" value="<?php echo set_value('ulevel'); ?>" name="ulevel" /><?php echo display_error('ulevel'); ?></p>
           
        <!--<fieldset>
        	<legend></legend><label>Active <input type="checkbox" name="active" <?php echo set_checkbox('active', '1'); ?> value="1" /></label></fieldset>-->
        <p><input class="submitbtn" type="submit" value="Save" /></p>
    <?php echo form_close(); ?>
</div>