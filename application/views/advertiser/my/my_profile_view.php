<?php echo form_open(base_url() . 'advertiser/my/validate_profile'); ?>
<?php foreach($userprofile as $up): ?>
	<p><label>First Name</label> <input type="text" name="fname" value="<?php echo $up->fname; ?>" /></p>
    <p><label>Last Name</label> <input type="text" name="lname" value="<?php echo $up->lname; ?>" /></p>
    <p><label>Address</label><span class="reqfld">*</span> <input type="text" name="address" value="<?php echo $up->address; ?>" /><?php echo form_error('address', '<span class="error">', '</span>'); ?></p>
	<p><label>Suburb</label> <input type="text" name="suburb" value="<?php echo $up->suburb; ?>" /></p>
    <p><label>Postcode</label> <input type="text" name="postcode" value="<?php echo $up->postcode; ?>" /></p>
<p><label>State</label> 
<select name="state">
    	<option value=""> -- Please select a state -- </option>
        <?php foreach($states as $s): ?>
        	<option value="<?php echo $s->s_id;?>" <?php echo cbo_selected($userprofile[0]->state, $s->s_id); ?> ><?php echo $s->name;?></option>
        <?php endforeach; ?>
    </select></p>
<p><label>Country</label> 
        <select name="country">
            <option value=""> -- Please select a country -- </option>
			<?php foreach($countries as $c): ?>
            	<option value="<?php echo $c->c_id; ?>"  <?php echo cbo_selected($userprofile[0]->country, $c->c_id); ?> ><?php echo $c->name; ?></option>
            <?php endforeach; ?>
        </select>
</p>
<p>
  <label>Primary Phone</label>
  <span class="reqfld">*</span> <input type="text" name="phone" value="<?php echo $up->phone; ?>" /><?php echo form_error('phone', '<span class="error">', '</span>'); ?></p>
    <p><label>Secondary Phone</label> <input type="text" name="phone2" value="<?php echo $up->phone2; ?>" /></p>
    <p><label>Email</label><span class="reqfld">*</span> <input type="text" name="email" value="<?php echo $up->email; ?>" /><?php echo form_error('email', '<span class="error"', '</span>'); ?></p>
    <p><label>Username</label> <input type="text" name="username" value="<?php echo $up->username; ?>" /></p>
    <p><label>Website</label> <input type="text" name="url" value="<?php echo $up->website; ?>" /></p>
    <p><input type="submit" value="Save My Profile" /></p>
<?php endforeach; ?>
<?php echo form_close(); ?>