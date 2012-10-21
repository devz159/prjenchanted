<div class="toolbar">
    <div class="titlebar">
      <h1>Add New States</h1>
	</div><div class="actionbutton"><a href="<?php echo base_url("admin/panel/section/states"); ?>">Cancel New State</a></div><div class="clearthis"></div>

	<?php echo form_open(base_url("admin/panel/validatenewstate")); ?>
    	<p><label>Code</label><input type="text" name="code" /><?php echo display_error('code');  ?></p>
        <p><label>States</label><input type="text" name="state" /><?php echo display_error('state'); ?></p>
        <p><input class="submitbtn" type="submit" value="Save" /></p>
    <?php echo form_close(); ?>
</div>