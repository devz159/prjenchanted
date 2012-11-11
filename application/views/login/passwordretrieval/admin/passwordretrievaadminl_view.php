<?php
	$sessID = $this->session->all_userdata();
?>
<h3>Admin</h3>
<?php echo form_open(base_url('login/validateemailadmin')); ?>
<input type="hidden" name="sessid" value="<?php echo $sessID['session_id']; ?>" />
<input type="hidden" name="user" value="<?php echo $user; ?>" />
<p><label>Enter your email</label> <input type="text" name="email" value="<?php set_value('email'); ?>" /><?php echo display_error('email'); ?></p>
<p><input type="submit" value="Submit" /></p>
<?php echo form_close(); ?>