 <div>
	<div class="signuplistinggauge">
    	<p>Listing: Place Order<span class="grey"></span></p>
        <div class="sprite linegauge"></div>
    </div><div class="clearthis"></div>
    <p>&nbsp;</p>
  <?php echo form_open(/*'https://www.sandbox.paypal.com/cgi-bin/webscr'*/ paypalsettings::env(), array('method' => 'post', 'class' => 'newpaypal')); ?>
 
    	<h3>New Listing Entry</h3>
    	<h4>Title: <?php echo $title; ?></h4>
        <p>Package: <?php echo ($item_name !="") ?  ucfirst($item_name) . ' Listing' : ""; ?></p>
        <p>Amount: <span class="red"><?php echo $amount  . " " . $this->config->item('currency_code'); ?></span></p>
    

        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="upload" value="1">
        <input type="hidden" name="business" value="<?php echo $this->config->item('email_receiver'); ?>">
      	<input type="hidden" name="email" value="<?php echo $payer_email; ?>" />
        <input type="hidden" name="item_name_1" value="<?php echo ($item_name !="") ? ucfirst($item_name) . ' Listing': ''; ?>">
        <input type="hidden" name="item_number_1" value="<?php echo $lst_id . '-' . $advr; ?>">
        <input type="hidden" name="amount_1" value="<?php echo $amount; ?>">
        <input type="hidden" name="quantity_1" value="<?php echo $qty; ?>">      
        <input type="hidden" name="currency_code" value="<?php echo $this->config->item('currency_code'); ?>">
        <input type="hidden" name="lc" value="US">
        <input type="hidden" name="rm" value="2">
        <input type="hidden" name="shipping_1" value="0.00">
        <input type="hidden" name="return" value="<?php echo base_url(); ?>paypal/thankyou">
        <input type="hidden" name="cancel_return" value="<?php echo base_url('directory/listing'); ?>">
        <input type="hidden" name="notify_url" value="<?php echo base_url(); ?>paypal/process">
        <input type="submit" name="pay_now" value="Place Order Through PayPal" />
    </form>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</div>