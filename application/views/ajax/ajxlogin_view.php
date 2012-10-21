<?php echo form_open(base_url() . 'directory/listing/validate_login'); ?>
	<p><label>Username<span class="reqfld">*</span></label><input type="text" name="username" /><?php echo form_error('username', '<span class="error">', '</span>'); ?></p>
    <p><label>Password<span class="reqfld">*</span></label><input type="password" name="pword" /><?php echo form_error('pword', '<span class="error">', '</span>'); ?></p>
    <p class="forcbox" ><input id="rememberme" type="checkbox" name="rememberme" value="rememberme" /><label for="rememberme">Remember me</label></p>
    <p><input class="submitbtn" type="submit" value="Login" /></p>
   <p><?php echo anchor(base_url(). 'directory/listing/profile', 'Forgot my password', array('class' => 'forgotpassword')); ?></p>

<?php echo form_close(); ?>