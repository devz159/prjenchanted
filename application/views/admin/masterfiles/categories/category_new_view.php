<div class="toolbar">
                	<div class="titlebar">
                	  <h1>Add New Category</h1>
                      </div>
                      <div class="actionbutton"><a href="<?php echo base_url("admin/panel/section/categories"); ?>">Cancel New Category</a></div>
<div class="clearthis"></div>
    <?php echo form_open("admin/panel/validatenewcategory"); ?>
    	
        <p><label>Category</label><input type="text" name="category" /><?php echo display_error('category'); ?></p>
        <p><input class="submitbtn" type="submit" value="Save" /></p>
    <?php echo form_close(); ?>
</div>