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
        <form><h3>User Account</h3></form>
    <p style="padding-left:2em;"><input id="ismember" type="radio" name="member" value="ismember" /><label for="ismember">I'm already a member - I'd like to login.</label></p>
    <p style="padding-left:2em;"><input id="isnotmember" type="radio" name="member" checked="checked" value="isnotmember" /><label for="isnotmember">I'm not a member - I'd like to register</label></p>
    <div id="signup_form">
    <?php echo form_open(base_url() . 'directory/listing/validate_registration'); ?>
    <h3>Login Details</h3>
    <p><label>Username<span class="red">*</span> </label><input type="text" name="uname"  value="<?php echo set_value('uname'); ?>" /><?php echo form_error('uname', '<span class="error">', '</span>'); ?></p>
    <p><label>Password<span class="red">*</span> </label><input type="password" name="pword" /><?php echo form_error('pword', '<span class="error">', '</span>'); ?></p>
    <p><label>Confirm Password<span class="red">*</span> </label><input type="password" name="pword2" /><?php echo form_error('pword2', '<span class="error">', '</span>'); ?></p>
    <h3>Your Name</h3>
    <p><label>First Name</label><input type="text" name="fname" value="<?php echo set_value('fname'); ?>" /></p>
    <p><label>Last Name</label> <input type="text" name="lname" value="<?php echo set_value('lname'); ?>" /></p>
    <h3>Your Location</h3>
    <p><label>Street Address<span class="red">*</span></label> <input type="text" name="address" value="<?php echo set_value('address'); ?>" /><?php echo form_error('uname', '<span class="error">', '</span>'); ?></p>
    <p><label>Suburb/Town</label> <input type="text" name="suburb" value="<?php echo set_value('suburb'); ?>" /></p>
    <p><label>State </label>
    <select name="state">
        <option value=""> -- Please select a state -- </option>
        <?php foreach($states as $state): ?>
            <option value="<?php echo $state->s_id; ?>" <?php echo set_select('state', $state->s_id); ?>><?php echo $state->name; ?></option>
        <?php endforeach; ?>
        
    </select>
    </p>
    <p><label>Postcode </label><input type="text" name="postcode" value="<?php echo set_value('postcode'); ?>" /><?php form_error('postcode', '<span class="error">','</span>'); ?></p>
    <p><label>Country </label> 
    <select name="country">
        <option value=""> -- Please select a country -- </option>
        <?php foreach($countries as $c): ?>
            <option value="<?php echo $c->c_id?>" <?php echo set_select('country', $c->c_id); ?>><?php echo $c->name; ?></option>
        <?php endforeach; ?>
    </select>
    </p>
    <h3>Contact Details</h3>
    <p><label>Primary Phone</label><span class="red">*</span> <input type="text" name="phone1" value="<?php echo set_value('phone1'); ?>" /><?php echo form_error('phone1', '<span class="error">', '</span>'); ?></p>
    <p><label>Secondary Phone</label> <input type="text" name="phone2" value="<?php echo set_value('phone2'); ?>" /></p>
    <p><label>Email<span class="red">*</span></label> <input type="text" name="email" value="<?php echo set_value('email'); ?>" /><?php echo form_error('email', '<span class="error">', '</span>'); ?></p>
    <p><label>Website</label> <input type="text" name="website" value="<?php echo set_value('website'); ?>" /></p>
    <p><input class="submitbtn" type="submit" value="Register" /> &nbsp;</p>
    <?php echo form_close(); ?>
    </div>
</div>