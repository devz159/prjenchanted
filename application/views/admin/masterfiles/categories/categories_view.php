<div class="toolbar">
                	<div class="titlebar">
                	  <h1>Categories</h1></div>
                    <div class="actionbutton"><a href="<?php echo base_url("admin/panel/section/newcategory"); ?>">Add New</a></div>
                    <div class="extrabar"></div>
                </div>                
<div class="runninglist">
                	
                    <table width="745">
                    	<thead>
                        	<tr>
                            	<th width="50"><input class="cboxToggleSelectAll"  type="checkbox" /></th><th width="579">Name</th><th width="110">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
					<?php if(isset($categories)): ?>
                        	<?php foreach($categories as $categ): ?>
                        	<tr>
                            	<td><input class="cboxSelector" type="checkbox" /></td><td><?php echo $categ->category; ?></td>
                            	<td><a href="<?php echo base_url("admin/panel/section/editcategory/$categ->mcat_id"); ?>">Edit</a> | <a href="<?php echo base_url("admin/panel/section/deletecategory/$categ->mcat_id"); ?>">Delete</a></td>
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