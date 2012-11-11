<div class="logindlg">
	<?php echo form_open(base_url() . 'login/validate_admin_login'); ?>	
	<h1 class="sprite adminlogin">Newcastle-Hunter.com</h1>
    <p><label>Username </label><br /><input type="text" name="uname" tabindex="0" /><?php echo display_error('uname'); ?></p>
    <p><label>Password </label><br /><input type="password" name="pword" tabindex="1" /><?php echo display_error('pword'); ?></p>
    <div class="colleft">
    	<ul>
        	<li><input id="rememberme" type="checkbox" name="rememberme" /> <label for="rememberme">Remember me</label></li>
            <li><a href="<?php echo base_url('login/forgetpassword/' . strencode('admin')); ?>">Forget password?</a></li>
        </ul>
    </div>
    
    <div class="colright">
    	<input type="submit" value="Login" />
    </div>
    <?php echo form_close(); ?>
</div>