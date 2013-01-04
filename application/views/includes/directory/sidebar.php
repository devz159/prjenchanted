<div class="sidebar">
				<div class="antiScroll">
					<div class="antiscroll-inner">
						<div class="antiscroll-content">
							<div class="sidebar_filters">
                            	<?php echo form_open(base_url() . 'directory/search'); ?>
								<h3>Keyword</h3>
								<div class="filter_items">
									<input type="text" class="input-medium" name="searchquery"/>
                                    <button class="btn btn-gebo" type="submit" >Search <i class="icon-chevron-right icon-white"></i></button>
                                
                                <?php echo form_close(); ?>
								</div>
								<h3><i class="splashy-hcards_down"></i> Categories</h3>
								<div class="filter_items">
                                <ul class="list_a">
                                <?php if(isset($maincategories)): ?>
                	<?php foreach($maincategories as $mcateg): ?>
						<li>
                        	<a class="ext_disabled" href="<?php echo base_url(); ?>directory/search/search_categories/<?php echo $mcateg->mcat_id . '/' . url_title($mcateg->maincategory, 'underscore', TRUE);?>">
                            	<?php echo $mcateg->maincategory; ?> <em>(<?php echo $mcateg->count; ?>)</em>
                            </a>
                        </li>
                        
                    <?php endforeach; ?>
                     </ul>
                <?php endif; ?>
									
								</div>
								<h3><i class="splashy-marker_rounded_light_blue"></i> Location</h3>
								<div class="filter_items">
									<ul class="list_a">
                                    	<?php if(isset($locations)): ?>
                	<?php foreach($locations as $loc): ?>
                		<li>
                        	<a class="ext_disabled" href="<?php echo base_url() . 'directory/search/search_location/' . $loc->s_id . '/' . url_title($loc->name, 'underscore', TRUE); ?>"><?php echo $loc->code; ?> <em>(<?php echo $loc->count; ?>)</em></a>                        </li>                    
                    <?php endforeach; ?>
                <?php endif; ?>                
                                    </ul>
								</div>
								<h3><i class="splashy-star_boxed_full"></i> Favorites</h3>
								<div class="filter_items">
									
								</div>
								                  
						  </div>
						</div>
					</div>
				</div>
			</div>