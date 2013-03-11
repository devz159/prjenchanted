<div class="row-fluid search_page">
	<div class="span12">
		<h3 class="heading"><small>Search results for</small> <?php echo (isset($searchkeyword)) ? $searchkeyword: ''; ?></h3>
        	
        	<?php 
				if(isset($serpscount)): 
					if($serpscount > 0): ?>
            
                            <div class="well clearfix">
                                <div class="row-fluid">
                                    <div class="pull-left">Showing <?php echo getPositionPagination(7, (isset($offset_num_rows)? $offset_num_rows : 0)); ?> of <?php echo (isset($serpscount)) ? $serpscount : ''; ?> <?php echo (isset($serpscount)) ? (($serpscount > 1) ? 'Results' : 'Result') : ''; ?></div>
                                    <div class="pull-right">
                                        <!--<span class="sepV_c">
                                            Sort by:
                                            <select>
                                                <option>Name</option>
                                                <option>Date</option>
                                                <option>Relevance</option>
                                            </select>
                                        </span>
                                        <span class="sepV_c">
                                            View:
                                            <select>
                                                <option>12</option>
                                                <option>25</option>
                                                <option>50</option>
                                            </select>
                                        </span>-->
                                        <span class="result_view">
											<a href="javascript:void(0)" class="box_trgr sepV_b"><i class="icon-th-large"></i></a>
											<a href="javascript:void(0)" class="list_trgr"><i class="icon-align-justify"></i></a>
										</span>
                                    </div>
                                </div>
                            </div>
                           	<?php echo (isset($paginate)) ? $paginate : '' ; ?>		
			<?php 
					endif;
				endif; ?>
			<div class="search_panel clearfix">
                             
                                
                 <?php $cntr = 0; ?>
                 <?php if(isset($serps)): ?>
                 	<?php if($serpscount > 0): ?>
                    <?php foreach($serps as $result): ?>                            
						<div class="search_item clearfix">
                                    <span class="searchNb"><?php echo $cntr+1; ?>.</span>
                                    <div class="thumbnail pull-left">
                                    	<?php if(getThumbImg($result->images) != ""): ?>
	                                        <img src="<?php echo base_url(); ?>ads/<?php echo "$result->advr/thumbs/" . getThumbImg($result->images); ?>" />
                                        <?php else: ?>
                                        	<img src="<?php echo base_url('images/no_image_icon.jpg'); ?>" />
                                        <?php endif; ?>
                                    </div>
                                    <div class="search_content">
                                        <h4>
                                            <a data-toggle="modal" lst_id="<?php echo $result->id; ?>" href="#pageDetail" class="sepV_a ext_disabled"><?php echo $result->title; ?></a>
                                        </h4>
                                        <p class="sepH_b item_description"><?php echo strTruncate(htmlDecode($result->description), 450); ?></p>
                                        <p class="sepH_a"><strong>Categories: </strong> <?php echo getCategories($result->subcategory); ?></p>                                        <div class="row-fluid">
                                        	<div class="span5 mncFlagView">                                        
                                        <small><i class="splashy-map"></i> <?php echo strTruncate("$result->address, $result->postcode, $result->state, $result->country", 45); ?></small>, <small><i class="splashy-cellphone"></i> <?php echo $result->phone; ?></small> 
                                        	</div>
                                            <div class="span7" style="text-align:right;">
	                                            <small><a adtitle="<?php echo $result->title; ?>" lst_id="<?php echo $result->id; ?>" 
                                <?php 
									$infav = FALSE;
									if(isset($favorites)) {
										foreach($favorites as $fav) {
											if($fav->lst_id == $result->id) {
												$infav = TRUE;
												break;	
											}
										}
									}
									echo ($infav) ? 'class="favcached removefavoritesbtn"' : 'class="favoritesbtn"';
								?>
                                
                                
                                
                                 href="#"><?php echo ($infav) ? '<i class="splashy-star_full"></i> remove-favorites' : '<i class="splashy-star_empty"></i> add to favorites'; ?></a></small>
                                            </div>
										</div>
                                    </div>
						</div>
                        <?php $cntr++; ?>
                    <!-- end loop here-->
					<?php endforeach; ?> 
                    
                    <?php else: ?>
                    	<h2 class="heading">No records found</h2>
                    <?php endif; ?>           
			</div>
            <?php if($serpscount > 0): ?>
            	<?php echo (isset($paginate)) ? $paginate : '' ; ?>	
			<?php endif; ?>
	</div>
				
                <?php endif; ?>     
</div>
<div class="modal hide fade" id="pageDetail">
    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Listing Details</h3>
    </div>
    <div class="modal-body">
    	
    </div><!-- modal body-->
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
    </div>
</div>

