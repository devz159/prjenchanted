<div>
	<div class="signuplistinggauge">
    	<p>Listing: Repost<span class="grey"></span></p>
        <!--<ul>
        	<li><span class="sprite stepone">&nbsp;</span></li>
            <li><span class="sprite steptwo">&nbsp;</span></li>
            <li><span class="sprite stepthree">&nbsp;</span></li>
            <li><span class="sprite stepfour">&nbsp;</span></li>
            <li><span class="sprite stepfive">&nbsp;</span></li>
            <li><span class="sprite stepsix selected">&nbsp;</span></li>
        </ul>-->
        <div class="sprite linegauge"></div>
    </div><div class="clearthis"></div>
	<?php echo form_open(base_url() . 'directory/listing/validate_repost'); ?>
    <input type="hidden" name="lst_id" value="<?php echo $list_id; ?>" />
    <input type="hidden" name="advr" value="<?php echo $advr; ?>" />
    <div class="signupbcrumbs"><ul><li><a href="#" onclick="history.go(-1); return false;">back</a></li><!--<li><a href="<?php echo base_url(); ?>directory/listing">start over</a></li>--></ul></div>    
        <h3>Package Type</h3>
        <p class="forradbtn"><input type="radio" id="lststandard" name="listingtype" value="Standard" /><label for="lststandard">Standard Listing (FREE)</label></p>
        <p class="forradbtn"><input type="radio" id="lstpremium" name="listingtype" checked="checked" value="Premium" /><label for="lstpremium">Premium Listing</label></p>
    <div id="packagetypebox">
        <p>Recurring Type</p>
        <p class="forradbtn"><input type="radio" checked="checked" id="permonth" name="recurrentpay" value="premium" /><label for="permonth">$29 per month</label></p>
       
        <h3>Paypal Account</h3>
        
        <p><label>Please provide your paypal account<span class="reqfld">*</span></label> <input type="text" name="paypalaccnt" /><?php echo form_error('paypalaccnt', '<span class="error">', '</span>'); ?></p>
        <p>&nbsp;</p>
        <p><input class="submitbtn" type="submit" value="List My Paid Ad" /></p>
    </div>
    <?php echo form_close(); ?>
</div>