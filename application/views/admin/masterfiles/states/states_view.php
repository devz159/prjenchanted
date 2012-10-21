<div class="toolbar">
                	<div class="titlebar">
                	  <h1>States</h1></div>
                    <div class="actionbutton"><a href="<?php echo base_url("admin/panel/section/newstate"); ?>">Add New</a></div>
                    <div class="extrabar"></div>
                </div>                
<div class="runninglist">
                	
                    <table width="745">
                    	<thead>
                        	<tr>
                            	<th width="50"><input class="cboxToggleSelectAll" type="checkbox" /></th>
                                <th width="150">Code</th>
                                <th width="415">Name</th>
                                <th width="110">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
					<?php if(isset($states)): ?>
                        	<?php foreach($states as $state): ?>
                        	<tr>
                            	<td><input class="cboxSelector" type="checkbox" /></td><td><?php echo $state->code; ?></td>
                                <td><?php echo $state->name; ?></td>
                            	<td><a href="<?php echo base_url("admin/panel/section/editstate/$state->s_id"); ?>">Edit</a> | <a href="<?php echo base_url("admin/panel/section/deletestate/$state->s_id"); ?>">Delete</a></td>
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