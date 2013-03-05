<div class="row-fluid search_page">
	<div class="span12">
		<h3 class="heading"><small>Search results for</small> <?php echo (isset($searchkeyword)) ? $searchkeyword: ''; ?></h3>
                            <div class="well clearfix">
                                <div class="row-fluid">
                                    <div class="pull-left">Showing 1 - 20 of <?php echo (isset($serpscount)) ? $serpscount : ''; ?> <?php echo (isset($serpscount)) ? (($serpscount > 1) ? 'Results' : 'Result') : ''; ?></div>
                                    <div class="pull-right">
                                        <span class="sepV_c">
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
                                        </span>
                                        <span class="result_view">
											<a href="javascript:void(0)" class="box_trgr sepV_b"><i class="icon-th-large"></i></a>
											<a href="javascript:void(0)" class="list_trgr"><i class="icon-align-justify"></i></a>
										</span>
                                    </div>
                                </div>
                            </div>
                            <div class="pagination">
                                <ul>
                                    <li><a href="#">Prev</a></li>
                                    <li class="active">
                                        <a href="#">1</a>
                                    </li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li class="disabled"><a href="#">...</a></li>
                                    <li><a href="#">10</a></li>
                                    <li><a href="#">Next</a></li>
                                </ul>
                            </div>
			<div class="search_panel clearfix">
                             
                                
                 <?php $cntr = 0; ?>
                 <?php if(isset($serps)): ?>
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
                                            <a lst_id="<?php echo $result->id; ?>" href="<?php echo base_url(); ?>directory/listing/details/overview/<?php echo $result->id; ?>" class="sepV_a ext_disabled"><?php echo $result->title; ?></a>
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
                                
                                class="favoritesbtn"
                                
                                 href="#"><?php echo ($infav) ? '<i class="splashy-star_full"></i> remove-favorites' : '<i class="splashy-star_empty"></i> add to favorites'; ?></a></small>
                                            </div>
										</div>
                                    </div>
						</div>
                        <?php $cntr++; ?>
                    <!-- end loop here-->
					<?php endforeach; ?>            
			</div>
	</div>
				
                <?php endif; ?>     
</div>

                    

