<div class="toolbar">
    <div class="titlebar">
      <h1>Edit Product</h1>                      
    </div>
    <div class="actionbutton"><a href="<?php echo base_url("admin/panel/section/products"); ?>">Cancel Edit Product</a></div>
    <div class="clearthis"></div>
	<?php if($products): ?>
    	<?php foreach($products as $prod): ?>
    <?php echo form_open("admin/panel/validateeditproduct"); ?>
    	<input type="hidden" name="prod_id" value="<?php echo $prod_id; ?>" />
    	<p><label>Name </label><input type="text" name="product" value="<?php echo $prod->name; ?>" /><?php echo display_error('product'); ?></p>
        <p><label>Price </label><input type="text" name="price" value="<?php echo $prod->price; ?>" /><?php echo display_error('price'); ?></p>
        <p><input class="submitbtn" type="submit" value="Save" /></p>
		<?php endforeach; ?>
	<?php endif; ?>
    <?php echo form_close(); ?>
</div>