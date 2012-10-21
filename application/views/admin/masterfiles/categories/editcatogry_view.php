<div class="toolbar">
                	<div class="titlebar">
                	  <h1>Edit Category</h1>
                      </div>
                      <div class="actionbutton"><a href="<?php echo base_url("admin/panel/section/categories"); ?>">Cancel Edit Category</a></div>
                      <div class="clearthis"></div>
    <?php echo form_open("admin/panel/validateeditcategory"); ?>
    	<?php if($categories) : ?>
        	<?php foreach($categories as $categ): ?>
    		<input type="hidden" name="categ_id" value="<?php echo $categ_id; ?>" />
            <p><label>Category</label><input type="text" name="category" value="<?php echo $categ->category; ?>" /><?php echo display_error('category'); ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
        <p><input class="submitbtn" type="submit" value="Save" /></p>
    <?php echo form_close(); ?>
</div>