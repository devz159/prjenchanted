<div>
    <div class="signuplistinggauge">
    	<p>Signup: <span class="grey">Images</span></p>
        <ul>
        	<li><span class="sprite stepone">&nbsp;</span></li>
            <li><span class="sprite steptwo">&nbsp;</span></li>
            <li><span class="sprite stepthree">&nbsp;</span></li>
            <li><span class="sprite stepfour selected">&nbsp;</span></li>
            <li><span class="sprite stepfive">&nbsp;</span></li>
            <li><span class="sprite stepsix">&nbsp;</span></li>
        </ul>
        <div class="sprite linegauge"></div>
    </div><div class="clearthis"></div>
   
    <form action="<?php echo base_url(); ?>directory/listing/validate_listing_four" method="post">
    <div class="signupbcrumbs"><ul><li class="firstchild"><a href="#" onclick="history.go(-1); return false;">back</a></li><li><a href="<?php echo base_url(); ?>directory/listing">start over</a></li></ul></div>
     <h3>Images</h3>
     <p><label>Upload Images*</label><?php echo form_error('file_uploader_images', '<span class="error">', '</span>'); ?></p><div class="clearthis"></div>
     
    <div style="height:20em; margin-left:2.5em;" id="file_uploader"></div>
    <p><input class="submitbtn images" type="submit" value="Submit" /></p>
    </form>
</div>