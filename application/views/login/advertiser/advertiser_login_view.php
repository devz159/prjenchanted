<div class="logindlg">
	<?php echo form_open(base_url() . 'login/validate_my_login'); ?>	
	<h1 class="sprite">Newcastle-Hunter.com</h1>
    <p><label>Username </label><br /><input type="text" name="uname" /><?php echo display_error('uname'); ?></p>
    <p><label>Password </label><br /><input type="password" name="pword" /><?php echo display_error('uname'); ?></p>
    <div class="colleft">
    	<ul>
        	<li><input id="rememberme" type="checkbox" name="rememberme" /> <label for="rememberme">Remember me</label></li>
            <li><a href="#">Forget password?</a></li>
        </ul>
    </div>
    
    <div class="colright">
    	<input type="submit" value="Login" />
    </div>
    <?php echo form_close(); ?>
</div>