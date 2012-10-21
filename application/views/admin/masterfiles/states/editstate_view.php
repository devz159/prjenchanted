<div class="toolbar">
    <div class="titlebar">
      <h1>Add New States</h1>
	</div>
    <div class="actionbutton"><a href="<?php echo base_url("admin/panel/section/states"); ?>">Cancel Edit State</a></div>
    <div class="clearthis"></div>
	<?php if($states): ?>
    	<?php foreach($states as $state): ?>
	<?php echo form_open(base_url("admin/panel/validateeditstate")); ?>
    	<input type="hidden" name="state_id" value="<?php echo $state_id; ?>" />
    	<p><label>Code</label><input type="text" name="code" value="<?php echo $state->code; ?>" /><?php echo display_error('code'); ?></p>
        <p><label>States</label><input type="text" name="state"  value="<?php echo $state->name; ?>"/><?php echo display_error('state'); ?></p>
        <p><input class="submitbtn" type="submit" value="Save" /></p>
        <?php endforeach; ?>
	<?php endif; ?>
    <?php echo form_close(); ?>
</div>