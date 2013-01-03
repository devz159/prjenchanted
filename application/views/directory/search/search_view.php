<div class="row-fluid search_page">
                        <div class="span12">
                            <h3 class="heading"><small>Search results for</small> Search term</h3>
                            <div class="well clearfix">
                                <div class="row-fluid">
                                    <div class="pull-left">Showing 1 - 20 of 204 Results</div>
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
                            <div id="searchbar">
                    <?php echo form_open(base_url() . 'directory/search'); ?>
                        <p><input type="text" name="searchquery" value="business title, description, location" />&nbsp;<button type="submit" >Search</button></p>
                        <p class="advancesearch"><a href="#">advance search +</a></p>
                    <?php echo form_close(); ?>
                </div> 
                                
                                <?php $cntr = 0; ?>
                 <?php if(isset($serps)): ?>
                    <?php foreach($serps as $result): ?>
                            
                                <div class="search_item clearfix">
                                    <span class="searchNb"><?php echo $cntr+1; ?>.</span>
                                    <div class="thumbnail pull-left">
                                    <?php if(getThumbImg($result->images) != ""): ?>
	                                        <img src="<?php echo base_url(); ?>ads/<?php echo "$result->advr/thumbs/" . getThumbImg($result->images); ?>" />
                                        <?php else: ?>
                                        	<img src="<?php echo base_url() . "images/no_image_icon.jpg"; ?>" />
                                        <?php endif; ?>
                                    </div>
                                    <div class="search_content">
                                        <h4>
                                            <a lst_id="<?php echo $result->id; ?>" href="<?php echo base_url(); ?>directory/listing/details/overview/<?php echo $result->id; ?>" class="sepV_a ext_disabled"><?php echo $result->title; ?></a>
                                        </h4>
                                        <p class="sepH_b item_description"><?php echo strTruncate(htmlDecode($result->description), 450); ?></p>
                                        <p class="sepH_a"><strong>Categories:</strong> <?php echo getCategories($result->subcategory); ?></p>
                                        <small><i class="splashy-map"></i> <?php echo strTruncate("$result->address, $result->postcode, $result->state, $result->country", 45); ?></small>, <small><i class="splashy-cellphone"></i> <?php echo $result->phone; ?></small>
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
                        </div>
                    </div>


              <?php endforeach; ?>
                    
                    <?php else: ?>
                    	<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>
                    <?php endif; ?>

