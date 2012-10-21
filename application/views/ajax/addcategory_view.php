<div>
<span class="hastooltip" tooltip="click to delete" id="<?php echo 'closebtn' . $id; ?>" cbo="<?php echo $id;?>">X</span>
<select id="<?php echo $id; ?>" name="category[]">
	<option value=""> -- Please select main category -- </option>
	
	<?php foreach ($mcategories as $mcat): ?>
		<option value="<?php echo $mcat->mcat_id?>"><?php echo $mcat->category; ?></option>
	<?php endforeach; ?>
</select>
<div style="margin-top:5px;"></div>
</div>