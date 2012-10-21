<div class="toolbar">
    <div class="titlebar">
      <h1>Add New Section</h1>
                 
    </div><div class="actionbutton"><a href="<?php echo base_url("admin/panel/section/sections"); ?>">Cancel New Section</a></div><div class="clearthis"></div>
    
    <?php echo form_open("./admin/panel/validatenewsection"); ?>
        <p><label>Name</label><input type="text" name="section" /><?php echo display_error('section'); ?></p>
        <p><input class="submitbtn" type="submit" value="Save" /></p>
    <?php echo form_close(); ?>
    </div>