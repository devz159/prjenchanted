<div class="toolbar">
                	<div class="titlebar">
                	  <h1>Sections</h1></div>
                    <div class="actionbutton"><a href="<?php echo base_url("admin/panel/section/newsection"); ?>">Add New</a></div>
                    <div class="extrabar"></div>
                </div>                
<div class="runninglist">
                	
                    <table width="745">
                    	<thead>
                        	<tr>
                            	<th width="50"><input class="cboxToggleSelectAll" type="checkbox" /></th><th>Name</th><th width="110">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
					<?php if(isset($sections)): ?>
                        	<?php foreach($sections as $sec): ?>
                        	<tr>
                            	<td><input class="cboxSelector" type="checkbox" /></td><td><?php echo $sec->name; ?></td>
                            	<td><a href="<?php echo base_url("admin/panel/section/editsection/$sec->sec_id"); ?>">Edit</a> | <a href="<?php echo base_url("admin/panel/section/deletesection/$sec->sec_id"); ?>">Delete</a></td>
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