<?php echo form_open('login/validatepasswordretrieval'); ?>
<input type="hidden" name="fullname" value="<?php echo $fullname; ?>" />
<input type="hidden" name="email" value="<?php echo $email; ?>" />
<input type="hidden" name="sessid" value="<?php echo $session_id; ?>" />
<input type="hidden" name="user" value="<?php echo strencode($user); ?>" />
	<p><label>Name: <?php echo $fullname; ?></label></p>
	<p><label>Email: <?php echo (isset($userInfo['email'])) ? $userInfo['email'] : ''; ?></label></p>
	<p><label>Enter your new password </label> <input type="password" name="password" /><?php echo display_error('password'); ?></p>
   	<p><label>Confirm your new password </label> <input type="password" name="password2" /><?php echo display_error('password2'); ?></p>
    <p><input type="submit" value="Change Password" /></p>
<?php echo form_close(); ?>