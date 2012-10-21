<div>
    <div class="signuplistinggauge">
    	<p>Signup: <span class="grey">Name and Location</span></p>
        <ul>
        	<li><span class="sprite stepone selected">&nbsp;</span></li>
            <li><span class="sprite steptwo">&nbsp;</span></li>
            <li><span class="sprite stepthree">&nbsp;</span></li>
            <li><span class="sprite stepfour">&nbsp;</span></li>
            <li><span class="sprite stepfive">&nbsp;</span></li>
            <li><span class="sprite stepsix">&nbsp;</span></li>
        </ul>
        <div class="sprite linegauge"></div>
    </div><div class="clearthis"></div>
	<?php echo form_open(base_url() . 'directory/listing/validate_listing_one'); ?>
    <div class="signupbcrumbs"><!--<ul><li class="firstchild"><a href="#" onclick="history.go(-1)">back</a></li><li><a href="#">start over</a></li></ul>--></div>
    <h3>Listing Title</h3>
    <p><label>Business Name<span class="reqfld">*</span></label> <input type="text" name="bname" value="<?php echo ((set_value('bname') == "") ? $cart['adTitle'] : set_value('bname')); ?>" /><?php echo form_error('bname', '<span class="error">', '</span>'); ?></p>
    <h3>Where Is It</h3>
    <p><label>Street Address</label> <input type="text" name="address" value="<?php echo ((set_value('address') == "") ? $cart['adStreetAddress'] : set_value('address')); ?>" /></p>
    <p><label>Suburb/Town<span class="reqfld">*</span></label> <input type="text" name="suburb" value="<?php echo ((set_value('suburb') == "") ? $cart['adSuburb'] : set_value('suburb')); ?>" /><?php echo form_error('suburb', '<span class="error">', '</span>'); ?></p>
    <p><label>Postcode<span class="reqfld">*</span></label> <input type="text" name="postcode" value="<?php echo ((set_value('postcode') == "") ? $cart['adPostcode'] : set_value('postcode')); ?>" /><?php echo form_error('postcode', '<span class="error">', '</span>'); ?></p>
    <p><label>State<span class="reqfld">*</span></label>
        <select name="state">
            <option value=""> -- Please select a state -- </option>
            <?php foreach($states as $s): ?>
                <option value="<?php echo $s->s_id; ?>" <?php echo ((strlen(set_select('state', $s->s_id)) > 0) ? set_select('state', $s->s_id) : (($cart['adState']==$s->s_id) ?  ' selected' : '') ); ?> > <?php echo $s->name; ?></option>
            <?php endforeach; ?>
        </select><?php echo form_error('state', '<span class="error">', '</span>'); ?>
    </p>
    <p><label>Country<span class="reqfld">*</span> </label>
    <select name="country">
        <option value=""> -- Please select a country -- </option>
         <?php foreach($countries as $c): ?>
                <option value="<?php echo $c->c_id; ?>" <?php echo ((strlen(set_select('country', $c->c_id)) > 0) ? set_select('country', $c->c_id) : (($cart['adCountry']==$c->c_id) ?  ' selected' : '') ); ?>> 		<?php echo $c->name; ?></option>
            <?php endforeach; ?>
    </select><?php echo form_error('country', '<span class="error">', '</span>'); ?>
    </p>
    <p><input class="submitbtn" type="submit" value="Next Step" /></p>
    <?php echo form_close(); ?>
    
</div>