<div class="toolbar">
                	<div class="titlebar">
                	  <h1>Sub-categories</h1></div>
                    <div class="actionbutton"><a href="<?php echo base_url("admin/panel/section/newsubcategory"); ?>">Add New</a></div>
                    <div class="extrabar"></div>
                </div>                
<div class="runninglist">
                	
                    <table width="745">
                    	<thead>
                        	<tr>
                            	<th width="50"><input class="cboxToggleSelectAll" type="checkbox" /></th>
                                <th width="306">Sub Category</th>
                                <th width="259">Main Category</th>
                                <th width="110">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
					<?php if(isset($subcategories)): ?>
                        	<?php foreach($subcategories as $scateg): ?>
                        	<tr>
                            	<td><input class="cboxSelector" type="checkbox" /></td><td><?php echo $scateg->sub_category; ?></td>
                                <td><?php echo $scateg->category; ?></td>
                            	<td><a href="<?php echo base_url("admin/panel/section/editsubcategory/$scateg->scat_id"); ?>">Edit</a> | <a href="<?php echo base_url("admin/panel/section/deletesubcategory/$scateg->scat_id"); ?>">Delete</a></td>
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