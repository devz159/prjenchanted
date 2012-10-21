<div>
	<h1>Your favorite items</h1>
    
    <ul>
    <?php if(isset($favorites)): ?>
		<?php foreach($favorites as $fav): ?>
            
            <li><strong><a href="<?php echo base_url() . 'directory/listing/details/' . $fav->lst_id; ?>"><?php echo $fav->title; ?></a></strong> &nbsp;<a class="removefavoritesbtn" lst_id="<?php echo $fav->lst_id; ?>" href="#">Remove this item</a></li>
        
        <?php endforeach; ?>
    <?php else: ?>
    	<p><strong>No items found in your favorite list.</strong></p>
    <?php endif; ?>
    
    </ul>
</div>