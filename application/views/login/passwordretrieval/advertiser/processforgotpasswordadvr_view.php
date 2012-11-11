<?php echo form_open(); ?>
	<p><label>email <?php echo (isset($email)) ? $email : ''; ?></label></p>
	<p><label>Enter your new password </label> <input type="password" name="password" /></p>
   	<p><label>Confirm your new password </label> <input type="password" name="password2" /></p>
    <p><input type="submit" value="Change Password" /></p>
<?php echo form_close(); ?>