<div>
  	<p class="changepasswordwarning"><?php echo ($result != '') ? $result : ''; ?></p>
    <?php echo form_open(base_url() . 'advertiser/my/validate_change_password'); ?>
    <p><span class="denotesrequired">* Denotes required</span></p>
  <p><label>Old Password<span class="reqfld">*</span> </label><input type="password" name="oldpword" /><?php echo form_error('oldpword', '<span class="error">', '</span>'); ?></p>
  <p><label>New Password<span class="reqfld">*</span></label><input type="password" name="newpword" /><?php echo strTruncate(form_error('newpword', '<span class="error">', '</span>'), 45); ?></p>
        <p><label>Confirm New Password<span class="reqfld">*</span></label><input type="password" name="newpword2" /><?php echo strTruncate(form_error('newpword2', '<span class="error">', '</span>'), 45); ?></p>
  <p><input class="submitbtn changepassword" type="submit" value="Change Password" /></p>
    <?php echo form_close(); ?>
</div>