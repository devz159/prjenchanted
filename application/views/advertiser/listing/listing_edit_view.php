<div>
	<div class="addnewlisting"><a href="<?php echo base_url() . 'advertiser/my/section/active_list'; ?>">Cancel Edit</a></div>
	<?php echo form_open(base_url() . 'advertiser/my/validate_edit'); ?>
    	<?php foreach($listing as $list): ?>
        	<h3>Listing Title</h3>
            <input type="hidden" name="id" value="<?php echo $list->lst_id; ?>" />
            <input type="hidden" name="advr" value="<?php echo $list->advr; ?>" />
		    <p><label>Business Name<span class="reqfld">*</span></label><input type="text" name="title" value="<?php echo $list->title; ?>" /><?php echo display_error('title'); ?></p>
            <h3>Where Is It</h3>
            <p><label>Street</label> <input type="text" name="street" value="<?php echo $list->address; ?>" /></p>
            <p><label>Suburb<span class="reqfld">*</span></label> <input type="text" name="suburb" value="<?php echo $list->suburb; ?>" /><?php echo display_error('suburb'); ?></p>
            <p><label>Postcode<span class="reqfld">*</span></label> <input type="text" name="postcode" value="<?php echo $list->postcode; ?>" /><?php echo display_error('postcode'); ?></p>
            <p><label>State<span class="reqfld">*</span></label>&nbsp;
            	<select name="state">
                	<option value=""> -- Please select a state -- </option>
                    <?php foreach($states as $state): ?>
                    	<option <?php echo ($state->s_id == $list->state) ? 'selected="selected"' : ''; ?> value="<?php echo $state->s_id; ?>"><?php echo $state->name; ?></option>
                    <?php endforeach; ?>
                </select><?php echo display_error('state'); ?>
            </p>
    		<p><label>Country<span class="reqfld">*</span></label>&nbsp;
            	<select name="country">
                	<option value=""> -- Please select a country -- </option>
                    <?php foreach($countries as $country): ?>
                    	<option <?php echo ($country->c_id == $list->country) ? 'selected="selected"' : '' ; ?> value="<?php echo $country->c_id;?>"><?php echo $country->name; ?></option>
                    <?php endforeach; ?>
            	</select><?php echo display_error('country'); ?>
            </p>
            <h3>How to Contact</h3>
            <p><label>Phone Number (Primary)<span class="reqfld">*</span></label> <input type="text" name="phone" value="<?php echo $list->phone; ?>" /><?php echo display_error('phone'); ?></p>
            <p><label>Phone Number (Secondary)</label> <input type="text" name="phone2" value="<?php echo $list->phone2; ?>" /></p>
            <p><label>Email<span class="reqfld">*</span></label> <input type="text" name="email" value="<?php echo $list->email; ?>" /><?php echo display_error('email'); ?></p>
            <p><label>Website URL</label> <input type="text" name="url" value="<?php echo $list->url; ?>" /></p>
            <h3>Full Details</h3>
            <p><label>Description<span class="reqfld">*</span></label><div id="editor"><?php echo $list->description; ?></div></p>
          
        <h3>Images</h3>
        
    	
        <p><label>Upload Images*</label><?php echo form_error('file_uploader_images', '<span class="error">', '</span>'); ?></p><div class="clearthis"></div>
     
    <div style="height:20em; margin-left:2.5em;" id="file_uploader"></div>
    	<div class="thumbnailbox">
        	<?php $imgcntr = 0; ?>
            <?php if(isset($images)): ?>
				<?php foreach($images as $image): ?>
                	<input type="hidden" name="curimages[]" value="<?php echo $image; ?>" />
                    <div tooltip="Click to delete this image" class="thumbnails hastooltip">
                    
                    <label for="<?php echo "img$imgcntr"; ?>"><img src="<?php echo base_url() . "ads/$list->advr/thumbs/$image"; ?>" /> <input id="<?php echo "img$imgcntr"; ?>" type="checkbox" name="delete[]" value="<?php echo $image; ?>" />delete?</label>
                    </div>
                    <?php $imgcntr++; // increments the coutner for the images ?>
                <?php endforeach; ?>
			<?php endif; ?>
        </div>
       <h3><label>Add Categories</label></h3>
            <p>Please select the most appropriate categories for your listing to appear in. You can submit to more than one category. If you can't find a suitable category, please suggest one by emailing us. If you have an adult-related business, please make sure you only list your services under the relevant 'Adult' categories.</p>
            <div class="categoryparentbox"><!--<p>Please select the most appropriate categories for your listing to appear in. You can submit to more than one category. If you can't find a suitable category, please suggest one by emailing us. If you have an adult-related business, please make sure you only list your services under the relevant 'Adult' categories.</p>-->
                <a class="hastooltip" tooltip="click to add new category" id="addcategorybtn" href="#">Add Category</a>
                <div class="categorybox">
                	<?php $id = 0; ?>
                    <?php if(isset($listingcategories)): ?>
						<?php foreach($listingcategories as $lstcateg): ?>
                            <div>
                                <span class="hastooltip" tooltip="click to delete" id="<?php echo 'closebtn' . $id; ?>" cbo="<?php echo $id;?>">X</span>
                                    <select id="<?php echo $id; ?>" name="category[]">
                                        <option value=""> -- Please select main category -- </option>
    
                                        <?php foreach ($mcategories as $mcat): ?>
                                            <option <?php echo ($mcat->mcat_id == $lstcateg->mcat_id) ? 'selected="selected"' : '' ; ?> value="<?php echo $mcat->mcat_id?>"><?php echo $mcat->category; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                            <div style="margin-top:5px;">
                                    &nbsp;&nbsp;<select name="subcategory[]">
                                    <option value=""> -- Please select main category -- </option>
                                    
                                    <?php foreach ($scategories as $scat): ?>
                                    <option <?php echo ($scat->scat_id == $lstcateg->scat_id) ? 'selected="selected"' : '' ; ?> value="<?php echo $scat->scat_id?>"><?php echo $scat->sub_category; ?></option>
                                    <?php endforeach; ?>
                                    </select>
                            </div>
                            </div>
                            <?php $id++; // increments the counter ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
    	<div class="clearthis"></div>
            <p><input class="submitbtn edit_listing" type="submit" value="Save" /></p>
    	<?php endforeach; ?>
    <?php echo form_close(); ?>
    <div class="addnewlisting"><a href="<?php echo base_url() . 'advertiser/my/section/active_list'; ?>">Cancel Edit</a></div>
</div>