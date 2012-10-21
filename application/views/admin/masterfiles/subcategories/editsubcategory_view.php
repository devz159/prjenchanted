<div class="toolbar">
    <div class="titlebar">
      <h1>Edit Sub-Category</h1>                      
    </div>
    <div class="actionbutton"><a href="<?php echo base_url("admin/panel/section/subcategories"); ?>">Cancel Edit Sub-Category</a></div>
    <div class="clearthis"></div>
    
	 <?php echo form_open("admin/panel/validateeditsubcategory"); ?>
     	<?php if($subcategories): ?>
        	<?php foreach($subcategories as $scateg): ?>
            <input type="hidden" name="subcateg_id" value="<?php echo $subcateg_id; ?>" />
    	<p><label>Main Category</label>
        	<select name="maincategory">
            	<option value=""> -- Select Main Category -- </option>
                <?php if($mcategories): ?>
                	<?php foreach($mcategories as $mcateg): ?>
                    	<option <?php echo ($mcateg->mcat_id == $scateg->mcat_id) ? ' selected="selected" ' : ''; ?> value="<?php echo $mcateg->mcat_id; ?>" <?php echo set_select('maincategory', $mcateg->mcat_id); ?>><?php echo $mcateg->category; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select><?php echo display_error('maincategory'); ?>
        </p>
        <p><label>Category</label><input type="text" name="subcategory" value="<?php echo $scateg->sub_category; ?>" /><?php echo display_error('subcategory'); ?></p>
        <p><input class="submitbtn" type="submit" value="Save" /></p>
        	<?php endforeach; ?>
       <?php endif; ?>
    <?php echo form_close(); ?>
</div>