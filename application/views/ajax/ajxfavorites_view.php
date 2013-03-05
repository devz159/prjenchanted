<?php if($action == 'add' || $action == 'remove'): ?>
	<?php if(isset($favorites)): ?>
    
        <?php foreach($favorites as $fav): ?>
    <li><a href="<?php echo base_url(); ?>directory/listing/details/<?php echo $fav->lst_id; ?>"><span></span><?php echo strTruncate($fav->title, 30); ?></a> <a lst_id="<?php echo $fav->lst_id; ?>" class="removefavsb ttip_r" title="remove-favorites" href="#"> <i class="splashy-tag_remove"></i></a></li>
        <?php endforeach; ?>
    <?php else: ?>
        <li><p><strong>No items found in your favorite list.</strong></p></li>
    <?php endif; ?>
<?php endif; ?>
                
