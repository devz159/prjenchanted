<div>
	<div class="signuplistinggauge">
    	<p>Signup: <span class="grey">User Account</span></p>
        <ul>
        	<li><span class="sprite stepone">&nbsp;</span></li>
            <li><span class="sprite steptwo">&nbsp;</span></li>
            <li><span class="sprite stepthree">&nbsp;</span></li>
            <li><span class="sprite stepfour">&nbsp;</span></li>
            <li><span class="sprite stepfive selected">&nbsp;</span></li>
            <li><span class="sprite stepsix">&nbsp;</span></li>
        </ul>
        <div class="sprite linegauge"></div>
    </div><div class="clearthis"></div>
    <div class="signupbcrumbs"><ul><li class="firstchild"><a href="#" onclick="history.go(-1); return false;">back</a></li><li><a href="<?php echo base_url(); ?>directory/listing">start over</a></li></ul></div>
    <form><h3>User Account</h3></form>
    <p style="padding-left:2em;"><input id="ismember" type="radio" name="member" checked="checked" value="ismember" /><label for="ismember">I'm already a member - I'd like to login.</label></p>
    <p style="padding-left:2em;"><input id="isnotmember" type="radio" name="member" value="isnotmember" /><label for="isnotmember">I'm not a member - I'd like to register</label></p>
    <div id="signup_form">
    <?php if(isset($accnterror) && $accnterror == TRUE): ?>
        <p><span class="error">Your username and password are incorrect</span></p>
    <?php endif; ?>
    <?php echo form_open(base_url() . 'directory/listing/validate_login'); ?>
    
        <p><label>Username<span class="reqfld">*</span></label><input type="text" name="username" /><?php echo form_error('username', '<span class="error">', '</span>'); ?></p>
        <p><label>Password<span class="reqfld">*</span></label><input type="password" name="pword" /><?php echo form_error('pword', '<span class="error">', '</span>'); ?></p>
        <p class="forcbox" ><input id="rememberme" type="checkbox" name="rememberme" value="rememberme" /><label for="rememberme">Remember me</label></p>
        <p><input class="submitbtn" type="submit" value="Login" /></p>

        <p><?php echo anchor(base_url(). 'directory/listing/profile', 'Forgot my password', array('class' => 'forgotpassword')); ?></p>
    
    <?php echo form_close(); ?>
    </div>
</div>