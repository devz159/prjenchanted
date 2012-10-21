&nbsp;&nbsp;<select name="subcategory[]">
	<option value=""> -- Please select main category -- </option>
	
	<?php foreach ($scategories as $scat): ?>
		<option value="<?php echo $scat->scat_id?>"><?php echo $scat->sub_category; ?></option>
	<?php endforeach; ?>
</select>