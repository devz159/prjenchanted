<div class="toolbar">
                	<div class="titlebar"><h1>Advertiser</h1></div>
                    <div class="actionbutton"><a href="#">Add New</a></div>
                    <div class="extrabar"></div>
                </div>                
<div class="runninglist">
                	
                    <table>
                    	<thead>
                        	<tr>
                            	<th><input type="checkbox" /></th><th>Name</th><th>Address</th><th>Phone</th><th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
					<?php if(isset($advertisers)): ?>
                        	<?php foreach($advertisers as $advr): ?>
                        	<tr>
                            	<td><input type="checkbox" /></td><td><?php echo $advr->fullname; ?></td><td><?php echo ucwords($advr->address); ?></td><td><?php echo ucwords($advr->phone); ?></td>
                            	<td><a href="#">Deactivate</a></td>
                            </tr>                            
							<?php endforeach; ?>
					<?php endif; ?>

                        </tbody>
                    </table>
                    <div class="clearthis"></div>
                    <div class="bulkaction">
                    	<select name="bulkaction">
                        	<option value="">Bulk action</option>
                    		<option value="deleteselected">Delete selected</option>
                            <option value="deleteall">Delete all</option>
                    	</select>
					</div>
                    <div class="applybutton">
                    	<a href="#">Apply</a>
                    </div>
                </div>