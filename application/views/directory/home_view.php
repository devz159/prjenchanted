<?php

	echo anchor(base_url() . 'directory/register', 'Register')  . '<br />';
	echo anchor(base_url() . 'directory/listing', 'List My Business') . '<br />';
	echo anchor(base_url() . 'directory/search', 'Search Listing') . '<br />';	
	
?>
<div>
	<ul>
		<?php foreach($maincategories as $mc): ?>
            <li><a href="<?php echo base_url() . 'directory/search'; ?>"><?php echo $mc->category; ?></a></li>
        <?php endforeach; ?>
	</ul>
</div>