<div>
    <div class="signuplistinggauge">
    	<p>Signup: <span class="grey">Contact</span></p>
        <ul>
        	<li><span class="sprite stepone">&nbsp;</span></li>
            <li><span class="sprite steptwo selected">&nbsp;</span></li>
            <li><span class="sprite stepthree">&nbsp;</span></li>
            <li><span class="sprite stepfour">&nbsp;</span></li>
            <li><span class="sprite stepfive">&nbsp;</span></li>
            <li><span class="sprite stepsix">&nbsp;</span></li>
        </ul>
        <div class="sprite linegauge"></div>
    </div><div class="clearthis"></div>
<?php echo form_open(base_url() . 'directory/listing/validate_listing_two'); ?>
<div class="signupbcrumbs"><ul><li class="firstchild"><a href="#" onclick="history.go(-1); return false;">back</a></li><li><a href="<?php echo base_url(); ?>directory/listing">start over</a></li></ul></div>

<h3>How To Contact</h3>
<p><label>Phone Number (Primary)<span class="reqfld">*</span></label> <input type="text" name="phone1" value="<?php echo ((set_value('phone1') == "") ? $cart['adPhone1'] : set_value('phone1')); ?>" /><?php echo form_error('phone1', '<span class="error">', '</span>'); ?></p>
<p><label>Phone Number (Secondary)</label> <input type="text" name="phone2" value="<?php echo ((set_value('phone2') == "") ? $cart['adPhone2'] : set_value('phone2')); ?>" /></p>
<p><label>Email<span class="reqfld">*</span></label> <input type="text" name="email" value="<?php echo ((set_value('email') == "") ? $cart['adEmail'] : set_value('email')); ?>" /><?php echo form_error('email', '<span class="error">', '</span>'); ?></p>
<p><label>Website URL</label> <input type="text" name="website" value="<?php echo ((set_value('website') == "") ? $cart['adUrl'] : set_value('website')); ?>" /></p>
<p><input class="submitbtn" type="submit" value="Next Step" /></p>
<?php echo form_close(); ?>
</div>