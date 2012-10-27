<?php if(! $superadmin): ?>
	<div class="toolbar">
                	<div class="titlebar">
                	  <h1>General Settings</h1></div>
                    	
                    <div class="extrabar"></div>
                    <div class="runninglist">
                    	<p class="error">ACCESS DENIED! Sorry you don't have enough privilege. <?php echo anchor(base_url("admin/panel"), 'Go back to default page'); ?>.</p>
                   	</div>
                </div>
           <?php exit(); ?>     
<?php endif; ?>

<?php
	$mSettings = array();
	$mMajorCards = '';
	$mPaypal = '';
	
	// preps data
	foreach($settings as $setting) {
		$mSettings[$setting->setting] = $setting->value;
	}
	
	// payment methods
	$mSettings['paymethods'] = preg_split('/,/', $mSettings['paymethods']);
	
	if(count($mSettings['paymethods']) > 0) {
		foreach($mSettings['paymethods'] as $val) {
			if(strtolower($val) == 'majorcards')
				$mMajorCards = trim($val);
			else
				$mPaypal = trim($val);
		}
	}
	
	/*call_debug($mSettings, FALSE);
	on_watch($mMajorCards . '-- ' .$mPaypal);*/
?>
<div class="toolbar">
                	<div class="titlebar">
                	  <h1>General Settings</h1></div>
                    
                    <div class="extrabar"></div>
                </div>                
<div class="runninglist">
<?php echo form_open(base_url() . 'admin/panel/validateeditsettings'); ?>
	<p><label>Site URL</label> <input type="text" name="siteurl" value="<?php echo $mSettings['siteurl'] ;?>" /><br /><span class="sidenote"> Careful on this "Site URL" setting. You may loose proper links within your site when changing this.</span><?php echo display_error('siteurl'); ?> </p>
    <p><label>Encryption Key</label> <input type="text" name="encriptionkey" value="<?php echo $mSettings['encryption_key'] ;?>" /><br /><span class="sidenote"> This is used to enhance security in your site.<?php echo display_error('encriptionkey'); ?></p>
    <p><label>Cookie Name</label> <input type="text" name="cookiename" value="<?php echo $mSettings['sess_cookie_name'] ;?>" /><br /><span class="sidenote"> Where all your cookies are stored.</span><?php echo display_error('cookiename'); ?></p>
	<p><label>Currency</label>
    		<select name="currency">
    			<option value=""> -- Select a currency -- </option>
                <?php if(count($currencies) > 0): ?>
                	<?php foreach($currencies as $cur): ?>
		                <option  <?php echo (strtolower($mSettings['currency']) == strtolower($cur->code)) ? 'selected="selected"' : ''; ?> <?php echo set_select('currency', $cur->code); ?> value="<?php echo $cur->code; ?>"><?php echo ucwords($cur->currency); ?></option>
                	<?php endforeach; ?>
                <?php endif; ?>
    		</select>
	<?php echo display_error('currency'); ?></p>
    <p>
    	<label>Timezone</label> 
        	<select name="timezone">
            	<option value=""> -- Select a timezone -- </option>
                <option <?php echo ($mSettings['timezone'] == "Australia/West") ? 'selected="selected"' : '' ;?> <?php echo set_select('timezone', 'Australia/West'); ?> value="Australia/West">Western Australia (GMT +8:00)</option>
                <option <?php echo ($mSettings['timezone'] == "Australia/South") ? 'selected="selected"' : '' ;?> <?php echo set_select('timezone', 'Australia/South'); ?> value="Australia/South">Northern/Southern Australia (GMT +9:30)</option>
                <option <?php echo ($mSettings['timezone'] == "Australia/ACT") ? 'selected="selected"' : '' ;?> <?php echo set_select('timezone', 'Australia/ACT'); ?> value="Australia/ACT">ACT-Australia (GMT +10:00)</option>
            </select><?php echo display_error('timezone'); ?><br /><span class="sidenote"> When this is not set, server's local time zone is used.</span></p>
            
    	<fieldset>
            <legend>Payment Methods</legend>
            <label for="majorcards"><input id="majorcards" <?php echo ($mMajorCards == 'majorcards') ? 'checked="checked"' : '' ; ?> type="checkbox" name="paymethod[]" value="majorcards" />Major Credit/Debit Card</label>
            <label for="paypal"><input id="paypal" <?php echo ($mPaypal == 'paypal') ? 'checked="checked"' : '' ; ?> type="checkbox" name="paymethod[]" value="paypal" />Paypal</label>
        </fieldset>        
	<p><label>Paypal Account</label> <input type="text" name="paypalaccount" value="<?php echo $mSettings['paypalaccount'] ;?>" /><br /><span class="sidenote">This is required if you've checked the Paypal payment method.</span></p>
    <p><label>Merchant Account</label> <input type="text" name="merchantaccount" value="<?php echo $mSettings['merchantaccount'] ;?>" /><br /><span class="sidenote">This is required if you've checked the major credit/debit card payment method.</span></p>
    <fieldset>
        	<legend>Site Offline:</legend>
             <label for="offline"><input type="radio" id="offline" name="offline" value="offline" <?php echo ($mSettings['siteoffline'] == '1') ? 'checked="checked"' : '' ?> />Yes</label><label for="online"><input type="radio" id="online" name="offline" value="online" <?php echo ($mSettings['siteoffline'] == '0') ? 'checked="checked"' : '' ;?> />No</label>
        </fieldset>
    <p><label>Site Offline Message</label><br /><textarea class="generalsettings" name="offlinemsg"><?php echo $mSettings['offlinemsg']; ?></textarea></p>
 <fieldset><legend>Affiliate Program</legend><label for="showaffiliateprogram">Show on business profile page<input id="showaffiliateprogram" <?php echo ($mSettings['showaffiliateprogram'] == '1') ? 'checked="checked"' : '' ?> type="checkbox" name="showaffiliateprogram" value="1" /></label>
</fieldset>

<fieldset><legend>Paypal</legend>
	<label for="turnonpaypalsandbox">Turn on Paypal sandbox environment<input id="turnonpaypalsandbox" <?php echo ($mSettings['paypalsandbox'] == '1') ? 'checked="checked"' : '' ?> type="checkbox" name="showaffiliateprogram" value="1" />
</fieldset>
<p><input class="submitbtn" type="submit" value="Save Settings" /></p>
<div class="clearthis"></div>

<?php echo form_close(); ?>                    
                    
                </div>
                <p>&nbsp;</p>