<div class="toolbar">
                	<div class="titlebar">
                	  <h1>Edit Section</h1>
                      </div>
                      <div class="actionbutton"><a href="<?php echo base_url("admin/panel/section/sections"); ?>">Cancel Edit Section</a></div>
                      <div class="clearthis"></div>
    <?php echo form_open("admin/panel/validateeditsection"); ?>
    	<?php if($sections) : ?>
        	<?php foreach($sections as $sec): ?>
    		<input type="hidden" name="sec_id" value="<?php echo $sec_id; ?>" />
            <p><label>Name</label><input type="text" name="section" value="<?php echo $sec->name; ?>" /><?php echo display_error('section'); ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
        <p><input class="submitbtn" type="submit" value="Save" /></p>
    <?php echo form_close(); ?>
</div>