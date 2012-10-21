<?php echo form_open(base_url() . 'directory/listing/validate_listing_five'); ?>
	<h1>Step 5 - Listing Package</h1>
    <p>Directory Advertising Packages</p>
    
    <p>Package Type</p>
    <p><input type="radio" id="lststandard" name="listingtype" checked="checked" value="Standard" /><label for="lststandard">Standard Listing (FREE)</label></p>
    <p><input type="radio" id="lstpremium" name="listingtype" value="Premium" /><label for="lstpremium">Premium Listing</label></p>
   
    <p><input type="submit" value="List My Ad" /></p>
<?php echo form_close(); ?>