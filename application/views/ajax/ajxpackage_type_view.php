<?php if (strtolower($type) == 'standard'): ?>
	<p>&nbsp;</p>
	<p><input class="submitbtn" type="submit" value="List My Ad" /></p>
	
<?php elseif(strtolower($type) == 'premium'): ?>
	<p>Recurring Type</p>
    <p class="forradbtn"><input type="radio" checked="checked" id="permonth" name="recurrentpay" value="premium" /><label for="permonth">$29 per month</label></p>
    <!--<p class="forradbtn"><input type="radio" id="perannum" name="reccurentpay" value="249|perannum" /><label for="perannum"><strong>$249 per year - save $99</strong></label></p>-->
    <h3>Paypal Account</h3>
    <p class="forradbtn"><label>Please provide your paypal account<span class="reqfld">*</span></label> <input type="text" name="paypalaccnt" /><?php echo form_error('paypalaccnt', '<span class="error">', '</span>'); ?></p>
    <p>&nbsp;</p>
    <p><input class="submitbtn" type="submit" value="List My Paid Ad" /></p>
    
<?php endif; ?>