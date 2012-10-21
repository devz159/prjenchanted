<?php if(! $superadmin): ?>
	<div class="toolbar">
                	<div class="titlebar">
                	  <h1>Users</h1></div>
                    	
                    <div class="extrabar"></div>
                    <div class="runninglist">
                    	<p class="error">ACCESS DENIED! Sorry you don't have enough privilege. <?php echo anchor(base_url("admin/panel"), 'Go back to default page'); ?>.</p>
                   	</div>
                </div>
           <?php exit(); ?>     
<?php endif; ?>

<div class="toolbar">
                	<div class="titlebar">
                	  <h1>Users</h1></div>
                    <div class="actionbutton"><a href="<?php echo base_url("admin/panel/section/newuser"); ?>">Add New</a></div>
                    <div class="extrabar"></div>
                </div>                
<div class="runninglist">
                	
                    <table width="745">
                    	<thead>
                        	<tr>
                            	<th width="50"><input class="cboxToggleSelectAll" type="checkbox" /></th>
                                <th width="306">Username</th>
                                <th width="259">Fullname</th>
                                <th width="110">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
					<?php if(isset($users)): ?>
                        	<?php foreach($users as $user): ?>
                        	<tr>
                            	<td><input class="cboxSelector" type="checkbox" /></td><td><?php echo $user->uname; ?></td>
                                <td><?php echo $user->fullname; ?></td>
                            	<td><a href="<?php echo base_url("admin/panel/section/edituser/$user->us_id"); ?>">Edit</a> | <a href="<?php echo base_url("admin/panel/section/deleteuser/$user->us_id"); ?>">Delete</a></td>
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