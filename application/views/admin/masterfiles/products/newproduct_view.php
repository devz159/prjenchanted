<div class="toolbar">
    <div class="titlebar">
      <h1>Add New Product</h1>                      
    </div>
    <div class="actionbutton"><a href="<?php echo base_url("admin/panel/section/products"); ?>">Cancel New Product</a></div>
    <div class="clearthis"></div>
    <?php echo form_open("admin/panel/validatenewproduct"); ?>
    	<p><label>Name</label> <input type="text" name="product" value="<?php echo set_value('product'); ?>"/><?php echo display_error('product'); ?></p>
        <p><label>Price</label> <input type="text" name="price" value="<?php echo set_value('price'); ?>" /><?php echo display_error('price'); ?></p>
        <p><input class="submitbtn" type="submit" value="Save" /></p>
    <?php echo form_close(); ?>
</div>