<div id="searchbar">
                    <?php echo form_open(base_url() . 'directory/search'); ?>
                        <p><input type="text" name="searchquery" value="business title, description, location" />&nbsp;<button type="submit" >Search</button></p>
                        <p class="advancesearch"><a href="#">advance search +</a></p>
                    <?php echo form_close(); ?>
                </div>              

<div class="serpsbox">
                	
                    <?php if(isset($serpscount)): ?>
                    <div style="text-align:center;">
					
                  		<?php echo $this->googleadsense->createAdSense(1); ?>

                	<!--<img src="<?php echo base_url(); ?>images/googleads.png" />-->
                </div>
                    
                        <hr />
                        <div class="serpslabel"><div class="leftcol"><p><span class="strong black"><?php echo $serpscount . ' ' . (($serpscount > 1)? 'results' : 'result'); ?></span> <span class="grey">for "</span><span class="strong black"><?php echo $searchkeyword; ?></span><!--</span> <span>(page 1 of 3)</span>--></p></div><div class="rightcol"><p><label>sort by </label><select name="sorting">
                            <option value="relevance">relevance</option>
                            <option value="Recent">recent</option>
                        </select></p></div></div><div class="clearthis"></div>
                        <hr />
					<?php endif; ?>
                    
                    <?php $cntr = 0; ?>
                 <?php if(isset($serps)): ?>
                    <?php foreach($serps as $result): ?>
                        <div class="searchresultitem <?php echo (($cntr%2) != 0 ) ? 'odd' : 'even'; ?>"> <!-- result item -->
                            <div class="sprite claimtag"><p><?php echo $cntr+1; ?></p></div>
                            <div class="serpcontent">
                                <div class="businesslogo">
                                    <a lst_id="<?php echo $result->id; ?>" href="<?php echo base_url(); ?>directory/listing/details/overview/<?php echo $result->id; ?>">
                                    	<?php if(getThumbImg($result->images) != ""): ?>
	                                        <img src="<?php echo base_url(); ?>ads/<?php echo "$result->advr/thumbs/" . getThumbImg($result->images); ?>" />
                                        <?php else: ?>
                                        	<img src="<?php echo base_url() . "images/no_image_icon.jpg"; ?>" />
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <div class="businessdtl">
                                    <h4><a lst_id="<?php echo $result->id; ?>" href="<?php echo base_url(); ?>directory/listing/details/overview/<?php echo $result->id; ?>"><?php echo $result->title; ?></a></h4>
                                    <p><?php echo strTruncate(htmlDecode($result->description)); ?></p>
                                </div>
                            </div>
                            
                            <div class="serpfooter">
                                <div class="address"><p><span class="sprite"></span><?php echo strTruncate("$result->address, $result->postcode, $result->state, $result->country", 45); ?></p></div>
                                <div class="phone"><p><span class="sprite"></span><?php echo $result->phone; ?></p></div>
                                <div class="favorites"><p><a adtitle="<?php echo $result->title; ?>" lst_id="<?php echo $result->id; ?>" 
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
                                
                                 href="#"><span class="sprite"></span><?php echo ($infav) ? 'remove - favorites' : 'add to favorites'; ?></a></p></div>
                            </div>
                            <div class="clearthis"></div>
                        </div><!-- result item -->
                        <?php $cntr++; ?>
					<?php endforeach; ?>
                    
                    <?php else: ?>
                    	<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>
                    <?php endif; ?>
                </div>
                <p>&nbsp;</p>