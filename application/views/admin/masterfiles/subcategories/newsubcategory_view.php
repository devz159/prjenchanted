<div class="toolbar">
    <div class="titlebar">
      <h1>Add New Sub-Category</h1>                      
    </div>
    <div class="actionbutton"><a href="<?php echo base_url("admin/panel/section/subcategories"); ?>">Cancel New Sub-Category</a></div>
    <div class="clearthis"></div>
    
	 <?php echo form_open("admin/panel/validatenewsubcategory"); ?>
    	<p><label>Main Category</label>
        	<select name="maincategory">
            	<option value=""> -- Select Main Category -- </option>
                <?php if($mcategories): ?>
                	<?php foreach($mcategories as $mcateg): ?>
                    	<option value="<?php echo $mcateg->mcat_id; ?>" <?php echo set_select('maincategory', $mcateg->mcat_id); ?>><?php echo $mcateg->category; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select><?php echo display_error('maincategory'); ?>
        </p>
        <p><label>Category</label><input type="text" name="subcategory" value="<?php echo set_value('subcategory'); ?>" /><?php echo display_error('subcategory'); ?></p>
        <p><input class="submitbtn" type="submit" value="Save" /></p>
    <?php echo form_close(); ?>
</div>