<div>
	<div class="signuplistinggauge">
    	<p>Signup: <span class="grey">About</span></p>
        <ul>
        	<li><span class="sprite stepone">&nbsp;</span></li>
            <li><span class="sprite steptwo">&nbsp;</span></li>
            <li><span class="sprite stepthree selected">&nbsp;</span></li>
            <li><span class="sprite stepfour">&nbsp;</span></li>
            <li><span class="sprite stepfive">&nbsp;</span></li>
            <li><span class="sprite stepsix">&nbsp;</span></li>
        </ul>
        <div class="sprite linegauge"></div>
    </div><div class="clearthis"></div>
	<?php echo form_open(base_url() . 'directory/listing/validate_listing_three', array('class' => 'elrte')); ?>
		<div class="signupbcrumbs"><ul><li class="firstchild"><a href="#" onclick="history.go(-1); return false;">back</a></li><li><a href="<?php echo base_url(); ?>directory/listing">start over</a></li></ul></div>
        <h3>Full Details</h3>
        <p><?php echo form_error('editor', '<span class="error">', '</span>'); ?></p>
        <p><label>Description<span class="reqfld">*</span></label><div id="editor"></div></p>
        <p>
            <label>Add Categories</label></p>
            
            <div class="categoryparentbox"><p>Please select the most appropriate categories for your listing to appear in. You can submit to more than one category. If you can't find a suitable category, please suggest one by emailing us. If you have an adult-related business, please make sure you only list your services under the relevant 'Adult' categories.</p>
                <a class="hastooltip" tooltip="Click to add new category" id="addcategorybtn" href="#">Add Category</a>
                <div class="categorybox">
                    
                </div>
            </div>
    	<div class="clearthis"></div>
        <p>&nbsp;</p>

        <p><input class="submitbtn" type="submit" value="Next Step" onClick="javascript:getcontent();" /></p>
    <?php echo form_close(); ?>
</div>