<div class="toolbar">
                	<div class="titlebar">
                	  <h1>Articles</h1></div>
                    <!--<div class="actionbutton"><a href="#">Add New</a></div>-->
                    <div class="extrabar"></div>
                </div>                
<div class="runninglist">
                	
                    <table width="745">
                    	<thead>
                        	<tr>
                            	<th width="50"><input class="cboxToggleSelectAll" type="checkbox" /></th>
                            	<th width="229">Title</th>
                            	<th width="241">Content</th>
                            	<th width="101">Created</th>
                            	<th width="100">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
					<?php if(isset($articles)): ?>
                        	<?php foreach($articles as $artcle): ?>
                        	<tr>
                            	<td><input class="cboxSelector"  type="checkbox" /></td>
                                <td><?php echo $artcle->title; ?></td>
                                <td><?php echo strTruncate(htmlDecode($artcle->article),80); ?></td>
                                <td><?php echo $artcle->created; ?></td>
                            	<td><a href="<?php echo base_url("admin/panel/section/editarticle/$artcle->arcle_id"); ?>">Edit</a> | <a href="#">Delete</a></td>
                            </tr>                            
							<?php endforeach; ?>
					<?php endif; ?>

                        </tbody>
                    </table>
<div class="clearthis"></div>
                    <div><?php echo $pagination; ?></div>
                    <!--<div class="bulkaction">
                    	<select name="bulkaction">
                        	<option value="">Bulk action</option>
                    		<option value="deleteselected">Delete selected</option>
                            <option value="deleteall">Delete all</option>
                    	</select>
					</div>
                    <div class="applybutton">
                    	<a href="#">Apply</a>
                    </div>-->
                </div>