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
                            	<?php if(isset($serpscount)): ?>
                                
                                <?php endif; ?>
                                
                                <?php $cntr = 0; ?>
                 <?php if(isset($serps)): ?>
                    <?php foreach($serps as $result): ?>
                            
                                <div class="search_item clearfix">
                                    <span class="searchNb">1.</span>
                                    <div class="thumbnail pull-left">
                                        <img alt="" src="http://placehold.it/80x80/efefef">
                                    </div>
                                    <div class="search_content">
                                        <h4>
                                            <a href="javascript:void(0)" class="sepV_a">Lorem ipsum dolor sit amet</a>
                                        </h4>
                                        <p class="sepH_b item_description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In euismod commodo adipiscing. Nunc lobortis mauris sit amet lectus vulputate vitae porta nulla vehicula. Curabitur in fermentum dui. Integer lobortis odio in quam faucibus ornare. Vivamus sed nulla suscipit tortor volutpat aliquam. Ut a lorem in felis faucibus tincidunt. Duis consectetur pulvinar lacus non pulvinar. Phasellus tempor nisi at sem commodo id vehicula nisl aliquam.</p>
                                        <p class="sepH_a"><strong>Lorem ipsum:</strong> dolor sit amet</p>
                                        <small>Tag 1</small>, <small>Tag 2</small>
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

