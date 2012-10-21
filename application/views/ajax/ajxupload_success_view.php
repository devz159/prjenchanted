<?php if(isset($errors)):?>
	<script type="text/javascript">
	var strDOM = '';
	var strFilename = '';
		strFilename = '<?php echo $file_data['name']; ?>';
	strDOM += '<li><div class="colone"><?php echo $file_data['name']; ?></div><div class="coltwo"><?php echo intval($file_data['size']) . 'kb'; ?></div><div class="colthree"><span style="color:red;"><?php echo $errors; ?></span></div><div class="colfour"><a alt="delete" class="sprite_loader uploaderdeleteicon" href="#"></a></div></li>';
	window.top.window.displayResult(strDOM, strFilename);
</script>
<?php else: ?>
	<script type="text/javascript">
        var strDOM = '';
		var strFilename = '';
		strFilename = '<?php echo $file_data['file_name']; ?>';
		strDOM += '<li><div class="colone"><?php echo $file_data['file_name']; ?></div><div class="coltwo"><?php echo intval($file_data['file_size']) . 'kb'; ?></div><div class="colthree">Uploaded</div><div class="colfour"><a alt="delete" class="sprite_loader uploaderdeleteicon" href="#"></a></div></li>';
        window.top.window.displayResult(strDOM, strFilename);
    </script>

<?php endif; ?>
